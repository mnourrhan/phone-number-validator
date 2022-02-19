<?php

namespace Tests\Unit;

use App\Enums\CachingPhoneListKeysEnum;
use App\Models\Customer;
use App\PhoneRegex\PhoneRegexFactory;
use App\Services\CachingCustomersWithInvalidPhoneService;
use App\Services\CachingValidPhoneNumbersService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CachePhoneListTest extends TestCase
{
    /**
     * @test
     */
    public function is_customers_ids_cached()
    {
        app(CachingCustomersWithInvalidPhoneService::class)->execute();
        $this->assertTrue(Cache::has(CachingPhoneListKeysEnum::CUSTOMERS_IDS_WITH_INVALID_PHONE_CACHE_KEY));
    }

    /**
     * @test
     */
    public function is_customers_phone_cached()
    {
        app(CachingValidPhoneNumbersService::class)->execute();
        $this->assertTrue(Cache::has(CachingPhoneListKeysEnum::VALID_PHONES_CACHE_KEY));
    }

    /**
     * @test
     */
    public function is_cached_customers_ids_all_have_invalid_phone()
    {
        app(CachingCustomersWithInvalidPhoneService::class)->execute();
        $cached_customers = Cache::get(CachingPhoneListKeysEnum::CUSTOMERS_IDS_WITH_INVALID_PHONE_CACHE_KEY);
        foreach ($cached_customers as $customer_id){
            $customer = Customer::find($customer_id);
            $country_code = get_country_between_parenthesis($customer->phone);
            $regexService = PhoneRegexFactory::getInstance($country_code);
            $this->assertEquals(preg_match("/" . $regexService::REGEX . "/", $customer->phone), 0);
        }
    }

}
