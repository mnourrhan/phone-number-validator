<?php


namespace App\Services;


use App\Filters\Customer\PhoneCountryFilter;
use App\Filters\Customer\PhoneStatusFilter;
use App\Repositories\CustomerRepository;
use Illuminate\Pipeline\Pipeline;

class IndexingPhoneNumbersService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * IndexingPhoneNumbersService constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return mixed
     */
    public function execute(){
        $customers = $this->customerRepository->query();
        $result = app(Pipeline::class)->send($customers)
                        ->through([
                            PhoneCountryFilter::class,
                            PhoneStatusFilter::class
                        ])
                        ->thenReturn()
                        ->paginate();

        return $result;
    }

}
