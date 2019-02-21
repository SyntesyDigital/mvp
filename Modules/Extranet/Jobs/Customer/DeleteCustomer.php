<?php

namespace Modules\Extranet\Jobs\Customer;

use Modules\Extranet\Entities\Customer;

class DeleteCustomer
{
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function handle()
    {
        return $this->customer->delete() > 0 ? true : false;
    }
}
