<?php

namespace Modules\Front\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Modules\Front\Mail\CandidateOfferAlertMail;
use Modules\Extranet\Entities\Offers\AlertCandidate;
use Mail;

class SendCandidateAlertsEmail extends Command
{

    protected $signature = 'candidates:alerts';
    protected $description = 'Send candidates offers alerts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $alerts = AlertCandidate::where('status', AlertCandidate::STATUS_PENDING)->get();

        foreach ($alerts as $alert) {
            Mail::to($alert->candidate->user->email)
                ->send(new CandidateOfferAlertMail($alert));
        }
    }
}
