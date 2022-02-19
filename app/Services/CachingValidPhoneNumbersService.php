<?php


namespace App\Services;

use App\Enums\CachingPhoneListKeysEnum;
use App\PhoneRegex\PhoneRegexFactory;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Cache;

class CachingValidPhoneNumbersService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    private $validPhoneNumbers = array();

    /**
     * CachingValidPhoneNumbersService constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }


    public function execute(){
        if(!Cache::has(CachingPhoneListKeysEnum::VALID_PHONES_CACHE_KEY)) {
            // chunk customers and cache only the valid phone numbers with key valid_phone_numbers
            $this->customerRepository->query()
                ->chunk(100, function ($customers) {
                    foreach ($customers as $customer) {
                        $phone = $customer->phone;
                        $county_code = get_country_between_parenthesis($phone);
                        $countryRegexInstance = PhoneRegexFactory::getInstance($county_code);
                        // if phone valid, add it to the validPhoneNumbers array
                        if ($countryRegexInstance->isPhoneValid($phone)) {
                            array_push($this->validPhoneNumbers, $phone);
                        }
                    }
                });
            // expire in 2 hours
            Cache::put(
                CachingPhoneListKeysEnum::VALID_PHONES_CACHE_KEY,
                $this->validPhoneNumbers,
                120 * 60
            );
        }
    }

}
