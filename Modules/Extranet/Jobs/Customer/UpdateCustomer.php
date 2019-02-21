<?php

namespace Modules\Extranet\Jobs\Customer;

use Modules\Extranet\Http\Requests\Admin\Customers\UpdateCustomerRequest;
use Modules\Extranet\Entities\Customer;

use Modules\Extranet\Traits\FormFields;

class UpdateCustomer
{
    use FormFields;

    public function __construct(Customer $customer, array $attributes = [])
    {
        $this->fields = $this->getFields(config('customers.form'));
        $this->attributes = array_only($attributes, $this->fields);
        $this->customer = $customer;
    }

    public static function fromRequest(Customer $customer, UpdateCustomerRequest $request)
    {
        return new self($customer, $request->all());
    }

    public function handle()
    {
        $this->customer->update($this->attributes);

        $this->saveFields($this->customer, 'documents');

        return true;
    }
}
