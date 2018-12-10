<?php

namespace Modules\RRHH\Jobs\Offers;

use Modules\RRHH\Jobs\SendEmailTemplate;
use Modules\RRHH\Entities\Offers\Application;

class MoveOfferApplication
{
    public function __construct(Application $application, int $offer_id)
    {
        $this->offer_id = $offer_id;
        $this->application = $application;
    }

    public function handle()
    {
        $this->application->offer_id = $this->offer_id;
        $this->application->status = Application::STATUS_PENDING;
        $this->application->save();

        switch ($this->application->status) {
            case Application::STATUS_REFUSED:
                dispatch((new SendEmailTemplate('APPLICATION_REFUSED', $this->application->candidate->user->email, [
                    'user' => $this->application->candidate->user,
                ])));
            break;
        }

        return $this->application;
    }
}
