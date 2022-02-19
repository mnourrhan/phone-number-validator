<?php


namespace App\Services;


use App\Enums\CachingPhoneListKeysEnum;
use App\PhoneRegex\PhoneRegexFactory;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Cache;

class CachingCustomersWithInvalidPhoneService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    private $customerIdsWithInvalidPhone = array();

    /**
     * CachingCustomersWithInvalidPhoneService constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * chunk customers and cache only the valid phone numbers with key CUSTOMERS_IDS_WITH_INVALID_PHONE_CACHE_KEY
     */
    public function execute(){
        if(!Cache::has(CachingPhoneListKeysEnum::CUSTOMERS_IDS_WITH_INVALID_PHONE_CACHE_KEY)) {
            $this->customerRepository->query()
                ->chunk(100, function ($customers) {
                    foreach ($customers as $customer) {
                        $phone = $customer->phone;
                        $county_code = get_country_between_parenthesis($phone);
                        $countryRegexInstance = PhoneRegexFactory::getInstance($county_code);
                        // if phone valid, add customer id to the customerIdsWithInvalidPhone array
                        if (!$countryRegexInstance->isPhoneValid($phone)) {
                            array_push($this->customerIdsWithInvalidPhone, $customer->id);
                        }
                    }
                });
            // expire in 2 hours
            Cache::put(
                CachingPhoneListKeysEnum::CUSTOMERS_IDS_WITH_INVALID_PHONE_CACHE_KEY,
                $this->customerIdsWithInvalidPhone,
                120 * 60
            );
        }
    }


}
