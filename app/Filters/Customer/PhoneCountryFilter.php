<?php


namespace App\Filters\Customer;


use App\Filters\Pipe;
use Closure;

class PhoneCountryFilter implements Pipe
{

    public function handle($customers, Closure $next)
    {
        if (request()->has('country_code')) {
            return $customers->where('phone', 'like', '(' . request()->get('country_code') . ')%');
        }
        return $next($customers);
    }
}
