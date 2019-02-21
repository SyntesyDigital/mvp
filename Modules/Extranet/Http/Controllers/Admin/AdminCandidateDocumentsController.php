<?php

namespace Modules\Extranet\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Extranet\Entities\Offers\Candidate;

use Modules\Extranet\Http\Requests\Admin\Candidate\UploadCandidateDocumentRequest;
use Modules\Extranet\Http\Requests\Admin\Candidate\DeleteCandidateDocumentRequest;
use Modules\Extranet\Jobs\Candidate\UploadCandidateDocument;
use Modules\Extranet\Jobs\Candidate\DeleteCandidateDocument;
use Modules\Extranet\Repositories\CandidateRepository;

use Session;
use Config;

class AdminCandidateDocumentsController extends Controller
{

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }

    public function data(Candidate $candidate)
    {

        $data = [
            'routes' => [
                'upload' => route('extranet.admin.candidates.documents.upload', $candidate),
                'delete' => route('extranet.admin.candidates.documents.delete', $candidate),
                'data' => route('extranet.admin.candidates.documents.data', $candidate),
            ],
            'documents' => $this->candidates->getDocuments($candidate)
        ];

        return response()->json($data, 200);
    }


    public function upload(Candidate $candidate, UploadCandidateDocumentRequest $request)
    {
        $documents = dispatch_now(UploadCandidateDocument::fromRequest($candidate, $request));

        return $documents ? response()->json([
            'success' => true,
            'data' => $documents
        ], 200) : response()->json([
            'success' => false
        ], 500);
    }


    public function delete(Candidate $candidate, DeleteCandidateDocumentRequest $request)
    {
        return dispatch_now(DeleteCandidateDocument::fromRequest($candidate, $request)) ? response()->json([
            'success' => true
        ], 200) : response()->json([
            'success' => false
        ], 500);
    }
}
