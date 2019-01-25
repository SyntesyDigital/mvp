<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Entities\Offers\Candidate;
use Modules\RRHH\Http\Requests\Admin\Candidate\DeleteCandidateDocumentRequest;
use Modules\RRHH\Repositories\CandidateRepository;
use Config;
use Storage;

class DeleteCandidateDocument
{
    public function __construct(Candidate $candidate, $attributes = null)
    {
        $this->candidate = $candidate;
        $this->attributes = $attributes;
        $this->repository = app()->make(CandidateRepository::class);
    }

    public static function fromRequest(Candidate $candidate, DeleteCandidateDocumentRequest $request)
    {
        return new self($candidate, $request->all());
    }

    public function handle()
    {
        //$document = $this->repository->getDocuments($this->candidate)->firstWhere('id', $this->attributes["id"]);
        $documents = $this->repository->getDocuments($this->candidate)->toArray();

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
            str_replace(':id', $this->candidate->id, Config::get('candidates.storage')),
            $document["stored_filename"]
        );

        if(Storage::has($filePath)) {
            Storage::delete($filePath);
        }

        // Update document field
        $this->candidate->documents = json_encode($docs);
        if($this->candidate->save()) {
            return true;
        }

        return false;
    }
}
