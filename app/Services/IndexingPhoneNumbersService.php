<?php


namespace App\Services;


use App\Enums\PhoneValidationStatusEnum;
use App\Filters\Customer\PhoneCountryFilter;
use App\Filters\Customer\PhoneStatusFilter;
use App\PhoneRegex\PhoneRegexFactory;
use App\Repositories\CustomerRepository;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Cache;

class IndexingPhoneNumbersService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var CachingValidPhoneNumbersService
     */
    private $cachingService;

    /**
     * IndexingPhoneNumbersService constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository,
                                CachingValidPhoneNumbersService $cachingService) {
        $this->customerRepository = $customerRepository;
        $this->cachingService = $cachingService;
    }

    /**
     * @return mixed
     */
    public function execute(){
        // cache valid phone numbers if not cached
        $this->cacheValidPhoneNumbers();
        // apply pipeline pattern with phone country and status filter then paginate the result
        $customers = $this->customerRepository->query();
        $result = app(Pipeline::class)->send($customers)
                        ->through([
                            PhoneCountryFilter::class,
                            PhoneStatusFilter::class
                        ])
                        ->thenReturn()->paginate()
                        ->through(function ($customer) {
                            return $this->mapCustomerData($customer);
                        });

        return $result;
    }

    /**
     * cache valid phone numbers if not
     */
    private function cacheValidPhoneNumbers(){
        if(!Cache::get('valid_phone_numbers')) {
            $this->cachingService->execute();
        }
    }

    /**
     * map the customer data to the needed data for display
     * @param $customer
     * @return array
     */
    private function mapCustomerData($customer){
        $country_code = get_country_between_parenthesis($customer->phone);
        $countryRegexClass = PhoneRegexFactory::getInstance($country_code);
        return [
            'country' => $countryRegexClass::COUNTRY_NAME,
            'code' => $countryRegexClass->getPrettyCode(),
            'status' => $countryRegexClass->isPhoneValid($customer->phone)
                            ? PhoneValidationStatusEnum::VALID_TEXT
                            : PhoneValidationStatusEnum::INVALID_TEXT,
            'phone' => get_phone_without_country($customer->phone),
        ];
    }

}
