<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\CustomerContact\CustomerContactRequest;
use Modules\RRHH\Jobs\CustomerContact\CreateCustomerContact;
use Modules\RRHH\Jobs\CustomerContact\DeleteCustomerContact;
use Modules\RRHH\Jobs\CustomerContact\UpdateCustomerContact;
use Modules\RRHH\Entities\Customer;
use Modules\RRHH\Entities\CustomerContact;
/*

use Modules\RRHH\Jobs\Tags\UpdateCustomerContactTags;
*/
use Modules\RRHH\Repositories\CustomerContactRepository;
use Session;

class CustomerContactController extends Controller
{
    public function __construct(CustomerContactRepository $customer_contacts)
    {
        $this->customer_contacts = $customer_contacts;
    }

    public function data(Customer $customer)
    {
        return $this->customer_contacts->getDatatableData($customer);
    }

    public function create(Customer $customer)
    {
        return view('rrhh::admin.customer_contacts.form', [
            'customer' => $customer,
            ]);
    }

    public function store(CustomerContactRequest $request)
    {
        try {
            $customer_contact = $this->dispatchNow(CreateCustomerContact::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('rrhh.admin.customer_contacts.show', $customer_contact);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.customer_contacts.create', ['customer' => $request->get('customer_id')])->withInput($request->toArray());
    }

    public function show(CustomerContact $customer_contact)
    {
        return view('rrhh::admin.customer_contacts.form', [
            'customer_contact' => $customer_contact,
            'customer' => $customer_contact->customer,
        ]);
    }

    public function update(CustomerContact $customer_contact, CustomerContactRequest $request)
    {
        try {
            $this->dispatchNow(UpdateCustomerContact::fromRequest($customer_contact, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.customer_contacts.show', $customer_contact);
    }

    public function delete(CustomerContact $customer_contact)
    {
        $customer = $customer_contact->customer;
        try {
            $this->dispatchNow(new DeleteCustomerContact($customer_contact));
            Session::flash('notify_success', 'Suppression effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.customers.show', $customer);
    }

    public function list(Customer $customer)
    {
        return response()->json(
        CustomerContact::where('customer_id', $customer->id)->orderBy('firstname')->pluck('id', 'firstname', 'lastname'), 200);
    }
}
