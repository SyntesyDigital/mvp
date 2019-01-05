<?php

namespace Modules\RRHH\Jobs\CustomerUser;
use Illuminate\Http\Request;

use App\Models\User;
use Modules\RRHH\Entities\Customer;
use Hash;


class DeleteCustomerUser
{
    public function __construct(Customer $customer, User $user, $attributes = [])
    {
        $this->customer = $customer;
        $this->user = $user;
    }

    public static function fromRequest(Customer $customer, User $user, Request $request)
    {
        return new self($customer, $user, $request->all());
    }


    public function handle()
    {
        return $this->user->delete();
    }
}
