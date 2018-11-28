<?php

namespace Modules\RRHH\Jobs\Customer;

use Modules\RRHH\Http\Requests\Customer\CustomerRequest;
use Modules\RRHH\Entities\Customer;

class UpdateCustomer
{
    public function __construct(Customer $customer, array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'name',
            'contact_firstname',
            'contact_lastname',
            'phone',
            'email',
            'address',
            'postal_code',
            'location',
        ]);
        $this->customer = $customer;
    }

    public static function fromRequest(Customer $customer, CustomerRequest $request)
    {
        return new self($customer, $request->all());
    }

    public function handle()
    {
        return $this->customer->update($this->attributes) ? $this->customer : false;
    }
}
