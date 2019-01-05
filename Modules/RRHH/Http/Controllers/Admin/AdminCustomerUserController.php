<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\RRHH\Entities\Customer;
use App\Models\User;

use Modules\RRHH\Http\Requests\Admin\CustomersUsers\CreateCustomerUserRequest;
use Modules\RRHH\Http\Requests\Admin\CustomersUsers\UpdateCustomerUserRequest;
use Modules\RRHH\Jobs\CustomerUser\CreateCustomerUser;
use Modules\RRHH\Jobs\CustomerUser\UpdateCustomerUser;
use Modules\RRHH\Jobs\CustomerUser\DeleteCustomerUser;

use Session;

class AdminCustomerUserController extends Controller
{

    public function data(Customer $customer)
    {
        $data = [
            'routes' => [
                'create' => route('rrhh.admin.customers.users.create', $customer),
                'data' => route('rrhh.admin.customers.users.data', $customer),
            ],
            'users' => $customer->users->map(function($user) use ($customer) {
                $user->routes = [
                    'update' => route('rrhh.admin.customers.users.update', [
                        'customer' => $customer,
                        'user' => $user
                    ]),
                    'delete' => route('rrhh.admin.customers.users.delete', [
                        'customer' => $customer,
                        'user' => $user
                    ]),
                ];

                return $user;
            })
        ];

        return response()->json($data, 200);
    }


    public function create(Customer $customer, CreateCustomerUserRequest $request)
    {
        $error = null;

        try {
            $user = $this->dispatchNow(CreateCustomerUser::fromRequest($customer, $request));

            return response()->json($user, 200);
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return response()->json([
            'error' => $error
        ], 500);
    }

    public function update(Customer $customer, User $user, UpdateCustomerUserRequest $request)
    {
        $error = null;

        try {
            $user = $this->dispatchNow(UpdateCustomerUser::fromRequest($customer, $user, $request));

            return response()->json($user, 200);
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return response()->json([
            'error' => $error
        ], 500);
    }

    public function delete(Customer $customer, User $user, Request $request)
    {
        $error = null;

        try {
            $this->dispatchNow(DeleteCustomerUser::fromRequest($customer, $user, $request));

            return response()->json([
                "success" => true
            ], 200);
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return response()->json([
            'error' => $error
        ], 500);
    }
}
