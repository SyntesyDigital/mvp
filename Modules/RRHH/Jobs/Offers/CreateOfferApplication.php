<?php

namespace Modules\RRHH\Jobs\Offers;

use Modules\RRHH\Jobs\SendEmailTemplate;
use Modules\RRHH\Entities\Offers\Application;
use Modules\RRHH\Entities\Offers\Offer;
use App\Models\User;
use Exception;

class CreateOfferApplication
{
    const EXCEPTION_ALREADY_APPLIED = 1;

    public function __construct(Offer $offer, User $user)
    {
        $this->offer = $offer;
        $this->user = $user;
    }

    public function handle()
    {
        if (Application::where('offer_id', $this->offer->id)->where('candidate_id', $this->user->candidate->id)->first()) {
            throw new Exception('Application already exists', self::EXCEPTION_ALREADY_APPLIED);
        }

        $application = Application::create([
            'offer_id' => $this->offer->id,
            'candidate_id' => $this->user->candidate->id,
            'status' => Application::STATUS_PENDING,
            'type' => Application::TYPE_OFFER,
            'done_at' => date('Y-m-d H:i:s'),
        ]);

        if ($application) {
            $file = [
                'path' => storage_path('app/public/candidates/'.$this->user->candidate->resume_file),
                'name' => 'CV.'.pathinfo($this->user->candidate->resume_file, PATHINFO_EXTENSION),
            ];

            $data = [
                'recipient' => $this->offer->recipient,
                'candidate' => $this->user->candidate,
                'offer' => $this->offer,
                'user' => $this->user,
            ];

            dispatch((new SendEmailTemplate('APPLICATION_RECEIVED_CANDIDATE', $this->user->email, $data)));
            dispatch((new SendEmailTemplate('APPLICATION_RECEIVED_RECRUITER', $this->offer->recipient->email, $data, $file)));
        }

        return $application ? $application : false;
    }
}
