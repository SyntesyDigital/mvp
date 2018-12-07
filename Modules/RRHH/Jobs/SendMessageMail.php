<?php

namespace Modules\RRHH\Jobs;

use Modules\RRHH\Mail\CandidateMessageMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendMessageMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $candidate;
    protected $subject;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct($subject, $message, $candidate)
    {
        $this->candidate = $candidate;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->candidate->user->email)
            ->send((new CandidateMessageMail($this->subject, $this->message, $this->candidate)));
    }
}
