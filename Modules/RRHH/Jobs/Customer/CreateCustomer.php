<?php

namespace Modules\RRHH\Jobs\Customer;

use Modules\RRHH\Http\Requests\Customer\CustomerRequest;
use Modules\RRHH\Entities\Customer;

class CreateCustomer
{
    public function __construct(
        array $attributes = [])
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
    }

    public static function fromRequest(CustomerRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $customer = new Customer($this->attributes);

        if ($customer->save()) {
            return $customer;
        }

        return false;
    }
}
