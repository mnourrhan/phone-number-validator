<?php


namespace App\Filters\Customer;


use App\Filters\Pipe;
use Closure;

class PhoneStatusFilter implements Pipe
{

    public function handle($customers, Closure $next)
    {
        return $next($customers);
    }
}
