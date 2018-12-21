<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\Customers\CreateCustomerRequest;
use Modules\RRHH\Http\Requests\Admin\Customers\UpdateCustomerRequest;
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

    public function data(Request $request)
    {
        return $this->customers->getDatatableData();
    }

    public function store(CreateCustomerRequest $request)
    {
        try {
            $customer = $this->dispatchNow(CreateCustomer::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectuée avec succès');
            return redirect()->route('rrhh.admin.customers.show', $customer);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.customers.create')->withInput();
    }

    public function update(Customer $customer, CustomerRequest $request)
    {
        try {
            $this->dispatchNow(UpdateCustomer::fromRequest($customer, $request));
            Session::flash('notify_success', 'Enregistrement effectuée avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.customers.show', $customer);
    }

    public function delete(Customer $customer)
    {
        try {
            $this->dispatchNow(new DeleteCustomer($customer));
            Session::flash('notify_success', 'Suppression effectuée avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.customers.index');
    }
}
