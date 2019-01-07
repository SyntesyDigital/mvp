<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\RRHH\Entities\Customer;

use Modules\RRHH\Http\Requests\Admin\Customers\UploadCustomerDocumentRequest;
use Modules\RRHH\Http\Requests\Admin\Customers\DeleteCustomerDocumentRequest;
use Modules\RRHH\Jobs\Customer\UploadCustomerDocument;
use Modules\RRHH\Jobs\Customer\DeleteCustomerDocument;
use Modules\RRHH\Repositories\CustomerRepository;

use Session;
use Config;

class AdminCustomerDocumentsController extends Controller
{

    public function __construct(CustomerRepository $customers)
    {
        $this->customers = $customers;
    }

    public function data(Customer $customer)
    {
        $data = [
            'routes' => [
                'upload' => route('rrhh.admin.customers.documents.upload', $customer),
                'delete' => route('rrhh.admin.customers.documents.delete', $customer),
                'data' => route('rrhh.admin.customers.documents.data', $customer),
            ],
            'documents' => $this->customers->getDocuments($customer)
        ];

        return response()->json($data, 200);
    }


    public function upload(Customer $customer, UploadCustomerDocumentRequest $request)
    {
        $documents = dispatch_now(UploadCustomerDocument::fromRequest($customer, $request));

        return $documents ? response()->json([
            'success' => true,
            'data' => $documents
        ], 200) : response()->json([
            'success' => false
        ], 500);
    }


    public function delete(Customer $customer, DeleteCustomerDocumentRequest $request)
    {
        return dispatch_now(DeleteCustomerDocument::fromRequest($customer, $request)) ? response()->json([
            'success' => true
        ], 200) : response()->json([
            'success' => false
        ], 500);
    }
}
