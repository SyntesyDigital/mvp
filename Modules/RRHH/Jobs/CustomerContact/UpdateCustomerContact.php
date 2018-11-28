<?php

namespace Modules\RRHH\Jobs\CustomerContact;

use Modules\RRHH\Http\Requests\CustomerContact\CustomerContactRequest;
use Modules\RRHH\Entities\CustomerContact;

class UpdateCustomerContact
{
    public function __construct(CustomerContact $customer_contact, array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'title',
            'firstname',
            'lastname',
            'function',
            'service',
            'email',
            'email_2',
            'phone_number_1',
            'phone_number_2',
            'fax',
            'customer_id',
        ]);
        $this->customer_contact = $customer_contact;
    }

    public static function fromRequest(CustomerContact $customer_contact, CustomerContactRequest $request)
    {
        return new self($customer_contact, $request->all());
    }

    public function handle()
    {
        return $this->customer_contact->update($this->attributes) ? $this->customer_contact : false;
    }
}
