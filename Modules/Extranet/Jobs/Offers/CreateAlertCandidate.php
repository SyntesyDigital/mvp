<?php

namespace Modules\Extranet\Jobs\Offers;

use Modules\Extranet\Entities\Offers\AlertCandidate;
use Modules\Extranet\Entities\Offers\Candidate;
use Modules\Extranet\Entities\Offers\Offer;

class CreateAlertCandidate
{
    public function __construct(Candidate $candidate, Offer $offer)
    {
        $this->offer = $offer;
        $this->candidate = $candidate;
    }

    public function handle()
    {
        $exist = AlertCandidate::where('candidate_id', $this->candidate->id)
            ->where('offer_id', $this->offer->id)
            ->whereIn('status', [
                AlertCandidate::STATUS_PENDING,
                AlertCandidate::STATUS_DONE,
            ])->count();

        if ($exist) {
            return false;
        }

        $alertCandidate = AlertCandidate::create([
            'candidate_id' => $this->candidate->id,
            'offer_id' => $this->offer->id,
            'status' => AlertCandidate::STATUS_PENDING,
        ]);

        if ($alertCandidate) {
            // HERE Mail dispatching on queue...

            return true;
        }

        return false;
    }
}
