<?php

namespace Modules\RRHH\Jobs;

use Modules\RRHH\Jobs\Candidate\SendMessageMail;
use Modules\RRHH\Entities\Offers\Candidate;
use App\Models\User;

class SendMassmail
{
    private $candidates = null;
    private $inputs = null;

    public function __construct(array $attributes = [])
    {
        $this->inputs = array_only($attributes, [
            'candidate',
            'interim',
            'subject',
            'reply_to',
            'message',
        ]);
    }

    public function handle()
    {
        $types = [];
        if (isset($this->inputs['candidate'])) {
            $types[] = Candidate::TYPE_NORMAL;
        }

        if (isset($this->inputs['interim'])) {
            $types[] = Candidate::TYPE_INTERIM;
        }

        $candidates = Candidate::whereHas('user', function ($query) {
            $query->where('status', User::STATUS_ACTIVE);
        })
            ->whereIn('type', $types)
            ->get();

        foreach ($candidates as $candidate) {
            $job = new SendMessageMail($this->inputs['subject'], $this->inputs['message'], $candidate);
            dispatch($job->onQueue('emails'));
        }

        return true;
    }
}
