<?php

namespace Modules\Front\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Modules\Extranet\Entities\Offers\AlertCandidate;

class CandidateOfferAlertMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $alert;

    /**
     * Create a new message instance.
     */
    public function __construct(AlertCandidate $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $alert = $this->alert;

        $this->withSwiftMessage(function ($message) use ($alert) {
            $alert->update([
                'status' => AlertCandidate::STATUS_DONE,
            ]);
        });

        return $this->view('front::emails.offer_alert', [
            'candidate' => $this->alert->candidate,
            'offer' => $this->alert->offer,
        ])->subject('Offre '.$this->alert->offer->title);
    }

    public function failed()
    {
        $this->alert->update([
            'status' => AlertCandidate::STATUS_ERROR,
        ]);
    }
}
