<?php

namespace Modules\RRHH\Jobs\CustomerUser;

use Modules\RRHH\Http\Requests\Admin\CustomersUsers\UpdateCustomerUserRequest;

use App\Models\User;
use App\Models\Role;
use Modules\RRHH\Entities\Customer;
use Hash;

class UpdateCustomerUser
{

    public function __construct(Customer $customer, User $user, array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'password',
            'telephone',
        ]);
        $this->customer = $customer;
        $this->user = $user;
    }

    public static function fromRequest(Customer $customer, User $user, UpdateCustomerUserRequest $request)
    {
        return new self($customer, $user, $request->all());
    }


    public function handle()
    {
        if(trim($this->attributes['password']) !== '') {
            $this->attributes['password'] = Hash::make(trim($this->attributes['password']));
        } else {
            array_forget($this->attributes, 'password');
        }

        $this->user->update($this->attributes);

        if(isset($this->attributes['role_id'])) {
            $this->user->roles()->sync($this->attributes['role_id']);
        } else {
            $this->user->roles()->sync(Role::where('name', 'customer')->first());
        }

        return $this->user;
    }
}
