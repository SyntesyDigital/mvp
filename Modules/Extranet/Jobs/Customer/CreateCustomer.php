<?php

namespace Modules\Extranet\Jobs\Customer;

use Modules\Extranet\Http\Requests\Admin\Customers\CreateCustomerRequest;

use Modules\Extranet\Entities\Customer;
use Modules\Extranet\Entities\CustomerField;

use Modules\Extranet\Traits\FormFields;

class CreateCustomer
{
    use FormFields;

    public function __construct(array $attributes = [])
    {
        $this->fields = $this->getFields(config('customers.form'));
        $this->attributes = array_only($attributes, $this->fields);
    }

    public static function fromRequest(CreateCustomerRequest $request)
    {
        return new self($request->all());
    }


    public function handle()
    {
        $customer = Customer::create([
            'status' => isset($this->attributes['status']) ? $this->attributes['status'] : Customer::STATUS_ACTIVE,
        ]);

        if($customer) {
            $this->saveFields($customer);
        }

        return $customer;
    }
}
