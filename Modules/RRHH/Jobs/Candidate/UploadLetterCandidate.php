<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Http\Requests\Candidate\CandidateLetterRequest;
use Auth;

class UploadLetterCandidate
{
    public function __construct($recommendation_letter)
    {
        $this->recommendation_letter = $recommendation_letter;
    }

    public static function fromRequest(CandidateLetterRequest $request)
    {
        return new self($request->file('recommendation_letter'));
    }

    public function handle()
    {
        $filePath = $this->recommendation_letter->storeAs(
            'public/candidates',
            uniqid(rand(), false).'.'.$this->recommendation_letter->getClientOriginalExtension()
        );

        $user = Auth::user();

        if ($filePath) {
            if ($user->candidate->recommendation_letter) {
                dispatch(new DeleteFile($user->candidate->recommendation_letter));
            }

            if ($user->candidate->update([
                'recommendation_letter' => str_replace('public/candidates/', '', $filePath),
            ])) {
                return $filePath;
            }
        }

        return false;
    }
}
