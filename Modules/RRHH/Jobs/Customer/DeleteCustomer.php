<?php

namespace Modules\RRHH\Jobs\Customer;

use Modules\RRHH\Entities\Customer;

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
