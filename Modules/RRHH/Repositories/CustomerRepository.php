<?php

namespace Modules\RRHH\Repositories;

use Modules\RRHH\Entities\Customer;
use Datatables;
use Prettus\Repository\Eloquent\BaseRepository;
use Config;

class CustomerRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\RRHH\\Entities\Customer";
    }

    public function getDocuments(Customer $customer)
    {
        $documents = json_decode($customer->getField('documents'), true);

        return collect($documents)->map(function($document) use ($customer) {
            $document["url"] = str_replace(':id', $customer->id, Config::get('customers.storage'));
            return $document;
        });
    }

    public function getDatatableData()
    {
        $results = Customer::leftJoin('customers_fields', 'customers.id', '=', 'customers_fields.customer_id')
            ->select(
                'customers.*'
            )
            ->groupBy('customers.id')
            ->orderBy('customers.updated_at','DESC')
            ->with('fields');

        return Datatables::of($results)
            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw("
                    customers_fields.value LIKE '%{$keyword}%'
                    AND customers_fields.name = 'name'
                ");
            })
            ->addColumn('name', function ($customer) {
                return $customer->name;
            })

            ->filterColumn('location', function ($query, $keyword) {
                $query->whereRaw("
                    customers_fields.value LIKE '%{$keyword}%'
                    AND customers_fields.name = 'city'
                ");
            })
            ->addColumn('location', function ($customer) {
                return $customer->getFieldValue('city');
            })
            ->addColumn('action', function ($customer) {
                return '<a href="'.route('rrhh.admin.customers.show', $customer).'" class="btn btn-sm btn-success pull-right">Modifier</a>';
            })
        ->make(true);
    }
}
