<?php


namespace App\Filters\Customer;


use App\Enums\PhoneValidationStatusEnum;
use App\Filters\Pipe;
use Closure;
use Illuminate\Support\Facades\Cache;

class PhoneStatusFilter implements Pipe
{

    public function handle($customers, Closure $next)
    {
        if(request()->has('status')){
            $validPhoneNumbers = Cache::get('valid_phone_numbers');
            if (request()->get('status') === PhoneValidationStatusEnum::VALID) {
                return $customers->whereIn('phone', $validPhoneNumbers);
            }
            return $customers->whereNotIn('phone', $validPhoneNumbers);
        }
        return $next($customers);
    }
}
