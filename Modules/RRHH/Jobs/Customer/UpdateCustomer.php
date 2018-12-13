<?php

namespace Modules\RRHH\Jobs\Customer;

use Modules\RRHH\Http\Requests\Admin\Customers\UpdateCustomerRequest;
use Modules\RRHH\Entities\Customer;

class UpdateCustomer
{
    public function __construct(Customer $customer, array $attributes = [])
    {
        $this->fields = $this->getFields(config('customers.form'));
        $this->attributes = array_only($attributes, $this->fields);
        $this->customer = $customer;
    }

    public static function fromRequest(Customer $customer, CustomerRequest $request)
    {
        return new self($customer, $request->all());
    }

    public function handle()
    {
        $this->customer->update($this->attributes);
        $this->saveFields($this->customer);

        return true;
    }
}
