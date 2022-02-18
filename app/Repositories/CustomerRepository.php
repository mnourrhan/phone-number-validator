<?php


namespace App\Repositories;


use App\Models\Customer;

class CustomerRepository extends Repository
{
    /**
     * CustomerRepository constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer) {
        parent::__construct($customer);
    }
}
