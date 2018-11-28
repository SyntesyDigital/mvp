<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Http\Requests\Candidate\CandidateCVRequest;
use Auth;

class UploadCVCandidate
{
    public function __construct($resume_file)
    {
        $this->resume_file = $resume_file;
    }

    public static function fromRequest(CandidateCVRequest $request)
    {
        return new self($request->file('resume_file'));
    }

    public function handle()
    {
        $filePath = $this->resume_file->storeAs(
            'public/candidates',
            uniqid(rand(), false).'.'.$this->resume_file->getClientOriginalExtension()
        );

        $user = Auth::user();

        if ($filePath) {
            if ($user->candidate->resume_file) {
                dispatch(new DeleteFile(Auth::user()->candidate->resume_file));
            }

            if ($user->candidate->update([
                'resume_file' => str_replace('public/candidates/', '', $filePath),
            ])) {
                return $filePath;
            }
        }

        return false;
    }
}
