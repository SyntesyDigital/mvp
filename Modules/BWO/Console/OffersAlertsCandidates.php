<?php

namespace Modules\BWO\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Modules\RRHH\Jobs\Offers\CreateAlertCandidate;
use Modules\RRHH\Entities\Offers\Offer;
use Carbon\Carbon;

class OffersAlertsCandidates extends Command
{
    protected $signature = 'offers:alerts';
    protected $description = 'Send offers alerts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $offers = Offer::whereField('start_at', Carbon::now()->format('d/m/Y'))
            ->where('status', Offer::STATUS_ACTIVE)
            ->get();

        foreach ($offers as $offer) {
            $candidates = $offer->getCandidatesToAlerts();

            if($candidates) {
                foreach ($candidates as $candidate) {
                    foreach ($candidates as $candidate) {
                        dispatch(new CreateAlertCandidate($candidate, $offer));
                    }
                }
            }
        }
    }
}
