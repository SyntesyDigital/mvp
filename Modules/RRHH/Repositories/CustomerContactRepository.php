<?php

namespace Modules\RRHH\Repositories;

use Modules\RRHH\Entities\Customer;
use Modules\RRHH\Entities\CustomerContact;
use Datatables;
use DB;
use Prettus\Repository\Eloquent\BaseRepository;

class CustomerContactRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\RRHH\\Entities\CustomerContact";
    }

    public function getDatatableData(Customer $customer)
    {
        $customer_contacts = CustomerContact::select([
                'customers_contacts.*',
                DB::raw("CONCAT(customers_contacts.firstname,' ',customers_contacts.lastname) as name"),
            ])->where('customer_id', $customer->id);

        return Datatables::of($customer_contacts)
            ->addColumn('name', function ($item) {
                return $item->name;
            })
            ->addColumn('function', function ($item) {
                return $item->function;
            })
            ->addColumn('email', function ($item) {
                return $item->email;
            })
            ->addColumn('phone_number_1', function ($item) {
                return $item->phone_number_1;
            })
            ->addColumn('action', function ($item) {
                return '<a href="'.route('admin.customer_contacts.show', $item).'" class="btn btn-sm btn-success pull-right">Modifier</a>';
            })
        ->make(true);
    }
}
