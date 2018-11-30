<?php

namespace Modules\RRHH\Jobs\Candidate;

use App\Models\User;

class DeleteCandidate
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        if ('' != $this->user->candidate->resume_file) {
            dispatch(new DeleteFile($this->user->candidate->resume_file));
        }
        if ('' != $this->user->candidate->recommendation_letter) {
            dispatch(new DeleteFile($this->user->candidate->recommendation_letter));
        }
        $this->user->candidate->delete();

        return $this->user->delete() > 0 ? true : false;
    }
}
