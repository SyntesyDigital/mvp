<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Customer\CustomerRequest;
use Modules\RRHH\Jobs\Customer\CreateCustomer;
use Modules\RRHH\Jobs\Customer\DeleteCustomer;
use Modules\RRHH\Jobs\Customer\UpdateCustomer;
use Modules\RRHH\Entities\Customer;
/*

use Modules\RRHH\Jobs\Tags\UpdateCustomerTags;
*/
use Modules\RRHH\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public function __construct(CustomerRepository $customers)
    {
        $this->customers = $customers;
    }

    public function index(Request $request)
    {
        return view('rrhh::admin.customers.index');
    }

    public function data(Request $request)
    {
        return $this->customers->getDatatableData();
    }

    public function create(Request $request)
    {
        return view('rrhh::admin.customers.form');
    }

    public function store(CustomerRequest $request)
    {
        try {
            $customer = $this->dispatchNow(CreateCustomer::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('admin.customers.show', $customer);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.customers.create')->withInput($request->toArray());
    }

    public function show(Customer $customer)
    {
        return view('rrhh::admin.customers.form', [
            'customer' => $customer,
        ]);
    }

    public function update(Customer $customer, CustomerRequest $request)
    {
        try {
            $this->dispatchNow(UpdateCustomer::fromRequest($customer, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.customers.show', $customer);
    }

    public function delete(Customer $customer)
    {
        try {
            $this->dispatchNow(new DeleteCustomer($customer));
            Session::flash('notify_success', 'Suppression effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.customers.index');
    }
}
