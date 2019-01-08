<?php

namespace Modules\RRHH\Jobs\Customer;

use Modules\RRHH\Http\Requests\Front\Customer\UpdateCustomerRequest;
use App\Models\User;
use Modules\RRHH\Jobs\User\UpdateUser;

use Modules\RRHH\Traits\FormFields;

class UpdateFrontCustomer
{
    use FormFields;

    public function __construct(User $user, array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
          'name',
          'email',
          'firstname',
          'lastname',
          'phone_number',
          'address',
          'postcode',
          'city',

          'image',
          'user_firstname',
          'user_lastname',
          'user_telephone',
          'user_email',
          'password'
        ]);

        $this->fields = $this->getFields(config('customers.form'));
        $this->customerAttributes = array_only($attributes, $this->fields);

        $this->user = $user;
    }

    public static function fromRequest(User $user, UpdateCustomerRequest $request)
    {
        return new self($user, $request->all());
    }

    public function handle()
    {

        $customer = $this->user->customer->first();

        $customer->update($this->customerAttributes);
        $this->saveFields($customer);


        $userAttributes = [
          'image' => $this->attributes['image'],
          'firstname' => $this->attributes['user_firstname'],
          'lastname' => $this->attributes['user_lastname'],
          'email' => $this->attributes['user_email'],
          'telephone' => $this->attributes['user_telephone'],
        ];

        $user = dispatch(new UpdateUser($this->user, $userAttributes));
        if (isset($this->attributes['type'])) {
            if (Candidate::TYPE_NORMAL == $this->user->candidate->type && Candidate::TYPE_INTERIM == $this->attributes['type']) {
                $this->user->candidate->registered_at = date('Y-m-d');
            }
            if (Candidate::TYPE_INTERIM == $this->attributes['type']) {
                $this->user->candidate->registration_number = $this->attributes['registration_number'] ? $this->attributes['registration_number'] : '';
            }
        }

        if (isset($this->attributes['password']) && null != $this->attributes['password']) {
            $this->user->password = bcrypt($this->attributes['password']);
        }

        return true;
    }
}
