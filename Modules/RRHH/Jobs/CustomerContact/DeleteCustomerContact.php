<?php

namespace Modules\RRHH\Jobs\CustomerContact;

use Modules\RRHH\Entities\CustomerContact;

class DeleteCustomerContact
{
    public function __construct(CustomerContact $customer_contact)
    {
        $this->customer_contact = $customer_contact;
    }

    public function handle()
    {
        return $this->customer_contact->delete() > 0 ? true : false;
    }
}
