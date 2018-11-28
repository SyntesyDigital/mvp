<?php

namespace Modules\RRHH\Jobs\CustomerContact;

use Modules\RRHH\Http\Requests\CustomerContact\CustomerContactRequest;
use Modules\RRHH\Entities\CustomerContact;

class CreateCustomerContact
{
    public function __construct(
        array $attributes = [])
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
    }

    public static function fromRequest(CustomerContactRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $customer_contact = new CustomerContact($this->attributes);

        if ($customer_contact->save()) {
            return $customer_contact;
        }

        return false;
    }
}
