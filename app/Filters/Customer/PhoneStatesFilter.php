<?php


namespace App\Filters\Customer;


use App\Enums\PhoneValidationStatesEnum;
use App\Filters\Pipe;
use Closure;
use Illuminate\Support\Facades\Cache;

class PhoneStatesFilter implements Pipe
{

    public function handle($customers, Closure $next)
    {
        if(request()->get('state')){
            $validPhoneNumbers = Cache::get('valid_phone_numbers');
            if (request()->get('state') == PhoneValidationStatesEnum::VALID) {
                $customers->whereIn('phone', $validPhoneNumbers);
            }else {
                $customers->whereNotIn('phone', $validPhoneNumbers);
            }
        }
        return $next($customers);
    }
}
