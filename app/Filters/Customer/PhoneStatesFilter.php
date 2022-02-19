<?php


namespace App\Filters\Customer;


use App\Enums\CachingPhoneListKeysEnum;
use App\Enums\PhoneValidationStatesEnum;
use App\Filters\Pipe;
use Closure;
use Illuminate\Support\Facades\Cache;

class PhoneStatesFilter implements Pipe
{

    public function handle($customers, Closure $next)
    {
        if(request()->get('state')){
            $customersIdsWithInvalidPhoneNumber = Cache::get(CachingPhoneListKeysEnum::CUSTOMERS_IDS_WITH_INVALID_PHONE_CACHE_KEY);
            if (request()->get('state') == PhoneValidationStatesEnum::INVALID) {
                $customers->whereIn('id', $customersIdsWithInvalidPhoneNumber);
            }else {
                $customers->whereNotIn('id', $customersIdsWithInvalidPhoneNumber);
            }
        }
        return $next($customers);
    }
}
