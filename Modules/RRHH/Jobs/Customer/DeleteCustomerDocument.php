<?php

namespace Modules\RRHH\Jobs\Customer;

use Modules\RRHH\Entities\Customer;
use Modules\RRHH\Http\Requests\Admin\Customers\DeleteCustomerDocumentRequest;
use Modules\RRHH\Repositories\CustomerRepository;


class DeleteCustomerDocument
{
    public function __construct(Customer $customer, $attributes = null)
    {
        $this->customer = $customer;
        $this->attributes = $attributes;
        $this->repository = app()->make(CustomerRepository::class);
    }

    public static function fromRequest(Customer $customer, DeleteCustomerDocumentRequest $request)
    {
        return new self($customer, $request->all());
    }

    public function handle()
    {
        $document = $this->repository->getDocuments($this->customer)->firstWhere('id', $this->attributes["id"]);

        print_R($document);
        exit();

        // $filePath = $document[""]
        //
        // $deleted = Storage::has($filePath) ? Storage::delete($filePath) : false;
        //
        // if($deleted) {
        //
        // }

    }
}
