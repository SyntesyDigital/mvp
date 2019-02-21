<?php

namespace Modules\Extranet\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Extranet\Http\Requests\Admin\Customers\CreateCustomerRequest;
use Modules\Extranet\Http\Requests\Admin\Customers\UpdateCustomerRequest;
use Modules\Extranet\Jobs\Customer\CreateCustomer;
use Modules\Extranet\Jobs\Customer\DeleteCustomer;
use Modules\Extranet\Jobs\Customer\UpdateCustomer;
use Modules\Extranet\Entities\Customer;
/*

use Modules\Extranet\Jobs\Tags\UpdateCustomerTags;
*/
use Modules\Extranet\Repositories\CustomerRepository;
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
            return redirect()->route('extranet.admin.customers.show', $customer);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.admin.customers.create')->withInput();
    }

    public function update(Customer $customer, CustomerRequest $request)
    {
        try {
            $this->dispatchNow(UpdateCustomer::fromRequest($customer, $request));
            Session::flash('notify_success', 'Enregistrement effectuée avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.admin.customers.show', $customer);
    }

    public function delete(Customer $customer)
    {
        try {
            $this->dispatchNow(new DeleteCustomer($customer));
            Session::flash('notify_success', 'Suppression effectuée avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.admin.customers.index');
    }
}
