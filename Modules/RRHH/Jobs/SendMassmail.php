<?php

namespace Modules\RRHH\Jobs;

use Modules\RRHH\Jobs\SendMessageMail;
use Modules\RRHH\Entities\Offers\Candidate;
use App\Models\User;

class SendMassmail
{
    private $candidates = null;
    private $inputs = null;

    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'recipients',
            'subject',
            'reply_to',
            'message',
        ]);
    }

    public function handle()
    {
        $candidates = Candidate::whereHas('user', function ($query) {
            $query->where('status', User::STATUS_ACTIVE);
        })
            ->whereIn('type', $this->attributes['recipients'])
            ->get();

        foreach ($candidates as $candidate) {
            $job = new SendMessageMail(
                $this->attributes['subject'],
                $this->attributes['message'],
                $candidate
            );
            dispatch($job->onQueue('emails'));
        }

        return true;
    }
}
