<?php

namespace Modules\Extranet\Jobs\Candidate;

use Modules\Extranet\Http\Requests\Admin\Candidate\UploadCandidateDocumentRequest;

use Modules\Extranet\Entities\Offers\Candidate;

use Modules\Extranet\Repositories\CandidateRepository;

use Auth;
use Config;

class UploadCandidateDocument
{
    public function __construct(Candidate $candidate, $file)
    {
        $this->file = $file;
        $this->candidate = $candidate;
        $this->repository = app()->make(CandidateRepository::class);
    }

    public static function fromRequest(Candidate $candidate, UploadCandidateDocumentRequest $request)
    {
        return new self($candidate, $request->file('file'));
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
        $this->filePath = $this->file->store(str_replace(':id', $this->candidate->id, Config::get('candidates.storage')));
    }

    public function handle()
    {
        $this->processFile();

        if($this->filePath) {
            // Retrieve documents and push new doc

            $documents = $this->repository->getDocuments($this->candidate)
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
            $this->candidate->documents = $documents->toJson();
            $this->candidate->save();

            return $documents->toArray();
        }

        return null;
    }
}
