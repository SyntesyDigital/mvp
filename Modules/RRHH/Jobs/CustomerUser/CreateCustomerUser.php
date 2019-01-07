<?php

namespace Modules\RRHH\Jobs\CustomerUser;

use Modules\RRHH\Http\Requests\Admin\CustomersUsers\CreateCustomerUserRequest;

use App\Models\User;
use App\Models\Role;
use Modules\RRHH\Entities\Customer;
use Hash;

class CreateCustomerUser
{

    public function __construct(Customer $customer, array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'password',
            'telephone',
        ]);
        $this->customer = $customer;
    }

    public static function fromRequest(Customer $customer, CreateCustomerUserRequest $request)
    {
        return new self($customer, $request->all());
    }


    public function handle()
    {
        $this->attributes['password'] = trim(Hash::make($this->attributes['password']));

        $user = User::create($this->attributes);
        $user->attachRole(Role::where('name', 'customer')->first());

        $this->customer->users()->save($user);

        if(isset($this->attributes['role_id'])) {
            $user->roles()->sync($this->attributes['role_id']);
        }

        return $user;
    }
}
