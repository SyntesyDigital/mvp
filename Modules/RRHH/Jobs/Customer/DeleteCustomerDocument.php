<?php

namespace Modules\RRHH\Jobs\Customer;

use Modules\RRHH\Entities\Customer;
use Modules\RRHH\Http\Requests\Admin\Customers\DeleteCustomerDocumentRequest;
use Modules\RRHH\Repositories\CustomerRepository;
use Config;
use Storage;

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

        $filePath = sprintf('%s/%s',
            str_replace(':id', $this->customer->id, Config::get('customers.storage')),
            $document["stored_filename"]
        );

        if(Storage::has($filePath)) {
            Storage::delete($filePath);
        }

        $attributes = $this->attributes;
        $documents = $this->repository->getDocuments($this->customer)->filter(function($document) use ($attributes){
            return $document["id"] !== $attributes["id"] ? true : false;
        });

        $this->customer->fields()->where('name', 'documents')->delete();

        // Save documents
        if($this->customer->saveField('documents', $documents->toJson())) {
            return true;
        }

        return false;
    }
}
