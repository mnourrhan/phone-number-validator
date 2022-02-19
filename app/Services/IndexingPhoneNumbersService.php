<?php


namespace App\Services;


use App\Enums\PhoneValidationStatesEnum;
use App\Filters\Customer\PhoneCountryFilter;
use App\Filters\Customer\PhoneStatesFilter;
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
        $phone_list = app(Pipeline::class)->send($customers)
                        ->through([
                            PhoneCountryFilter::class,
                            PhoneStatesFilter::class
                        ])
                        ->thenReturn()->paginate()
                        ->through(function ($customer) {
                            return $this->mapCustomerData($customer);
                        });

        $countries = PhoneRegexFactory::getCountriesCodeWithName();
        $phone_number_states = PhoneValidationStatesEnum::VALIDATION_STATES_TEXT;
        return compact('phone_list', 'countries', 'phone_number_states');
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
            'country_name' => $countryRegexClass::COUNTRY_NAME,
            'country_code' => $countryRegexClass->getPrettyCode(),
            'phone_status' => $countryRegexClass->isPhoneValid($customer->phone)
                            ? PhoneValidationStatesEnum::VALID_TEXT
                            : PhoneValidationStatesEnum::INVALID_TEXT,
            'phone_number' => get_phone_without_country($customer->phone),
        ];
    }

}
