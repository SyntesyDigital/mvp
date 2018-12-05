<?php

namespace Modules\RRHH\Jobs\Tags;

use Modules\RRHH\Entities\Offers\CandidateTag;
use App\Models\User;

class SaveCandidateTags
{
    const EXCEPTION_ALREADY_APPLIED = 1;

    public function __construct(User $user, $tag)
    {
        $this->tag = $tag;
        $this->user = $user;
    }

    public function handle()
    {
        $tag_exists = CandidateTag::where('tag_id', $this->tag)->where('candidate_id', $this->user->candidate->id)->first();
        if ($tag_exists) {
            throw new \Exception('Tag-Candidate already exists', self::EXCEPTION_ALREADY_APPLIED);
        } else {
            return $this->user->candidate->tags()->attach($this->tag);
        }
    }
}
