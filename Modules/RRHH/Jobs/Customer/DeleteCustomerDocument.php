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
        //$document = $this->repository->getDocuments($this->customer)->firstWhere('id', $this->attributes["id"]);
        $documents = $this->repository->getDocuments($this->customer)->toArray();

        $docs = [];
        $document = null;
        foreach($documents as $doc) {
            if($doc["id"] !== $this->attributes["id"]) {
                $docs[] = $doc;
            } else {
                $document = $doc;
            }
        }

        if(!$document) {
            return false;
        }

        // Remove file
        $filePath = sprintf('%s/%s',
            str_replace(':id', $this->customer->id, Config::get('customers.storage')),
            $document["stored_filename"]
        );

        if(Storage::has($filePath)) {
            Storage::delete($filePath);
        }

        // Update document field
        $this->customer->fields()->where('name', 'documents')->delete();

        if($this->customer->saveField('documents', json_encode($docs))) {
            return true;
        }

        return false;
    }
}
