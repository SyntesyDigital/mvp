<?php

namespace Modules\RRHH\Jobs\Customer;

use Modules\RRHH\Http\Requests\Admin\Customers\UploadCustomerDocumentRequest;

use Modules\RRHH\Entities\Customer;
use Modules\RRHH\Entities\CustomerField;

use Modules\RRHH\Repositories\CustomerRepository;

use Auth;
use Config;

class UploadCustomerDocument
{
    public function __construct(Customer $customer, $file)
    {
        $this->file = $file;
        $this->customer = $customer;
        $this->repository = app()->make(CustomerRepository::class);
    }

    public static function fromRequest(Customer $customer, UploadCustomerDocumentRequest $request)
    {
        return new self($customer, $request->file('file'));
    }

    private function getFileMimeType()
    {
        return $this->file->getMimeType();
    }

    private function getFileType()
    {
        return explode('/', $this->getFileMimeType())[0] ?: null;
    }

    private function processFile()
    {
        $this->filePath = $this->file->store(str_replace(':id', $this->customer->id, Config::get('customers.storage')));
    }

    public function handle()
    {
        $this->processFile();

        if($this->filePath) {
            // Retrieve documents and push new doc
            $documents = $this->repository->getDocuments($this->customer)
                ->push([
                    'id' => uniqid(),
                    'stored_filename' => basename($this->filePath),
                    'uploaded_filename' => $this->file->getClientOriginalName(),
                    'type' => $this->getFileType(),
                    'mime_type' => $this->getFileMimeType(),
                    'uploaded_by' => Auth::user()->id,
                    'url' => str_replace('public/', '/', $this->filePath)
                ]);

            // Remove field documents
            $this->customer->fields()->where('name', 'documents')->delete();

            // Save documents
            if($this->customer->saveField('documents', $documents->toJson())) {
                return $documents->toArray();
            }
        }

        return null;
    }
}
