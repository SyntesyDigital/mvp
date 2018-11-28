<?php

namespace Modules\RRHH\Repositories;

use Modules\RRHH\Entities\Customer;
use Datatables;
use Prettus\Repository\Eloquent\BaseRepository;

class CustomerRepository extends BaseRepository
{
    public function model()
    {
        return "App\\Models\Customer";
    }

    public function getDatatableData()
    {
        $customers = Customer::select(
                'id',
                'name',
                'location'
            );

        return Datatables::of($customers)
            ->addColumn('name', function ($item) {
                return $item->name;
            })
            ->addColumn('location', function ($item) {
                return $item->location;
            })
            ->addColumn('action', function ($item) {
                return '<a href="'.route('admin.customers.show', $item).'" class="btn btn-sm btn-success pull-right">Modifier</a>';
            })
        ->make(true);
    }
}
