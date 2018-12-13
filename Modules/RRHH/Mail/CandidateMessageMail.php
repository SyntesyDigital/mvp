<?php

namespace Modules\RRHH\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $candidate;
    protected $message;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $candidate)
    {
        $this->candidate = $candidate;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('rrhh::emails.candidate_message', [
            'candidate' => $this->candidate,
            'body' => $this->body,
        ])->subject($this->subject);
    }
}
