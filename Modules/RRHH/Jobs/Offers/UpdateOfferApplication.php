<?php

namespace Modules\RRHH\Jobs\Offers;

use Modules\RRHH\Http\Requests\Admin\Offers\UpdateOfferApplicationRequest;
use Modules\RRHH\Jobs\SendEmailTemplate;
use Modules\RRHH\Entities\Offers\Application;
use Modules\RRHH\Entities\Offers\Offer;
use Illuminate\Support\Facades\Mail;

class UpdateOfferApplication
{
    public function __construct(Application $application, string $status)
    {
        $this->application = $application;
        $this->status = $status;
    }

    public static function fromRequest(Application $application, UpdateOfferApplicationRequest $request)
    {
        return new self($application, $request->get('status'));
    }

    public function handle()
    {
        $this->application->status = $this->status;
        $this->application->save();

        switch ($this->application->status) {
            case Application::STATUS_PENDING:
            case Application::STATUS_TO_CONTACT:
            break;

            case Application::STATUS_REFUSED:
                dispatch((new SendEmailTemplate(config('emails_templates.application.refused'), $this->application->candidate->user->email, [
                    'user' => $this->application->candidate->user,
                ])));
            break;

            case Application::STATUS_INTERVIEW:

                // Send e-mail to the candidate
                dispatch((new SendEmailTemplate(config('emails_templates.application.interview'), $this->application->candidate->user->email, [
                    'user' => $this->application->candidate->user,
                ])));

                // Close offer
                $application->offer->status = Offer::STATUS_UNACTIVE;
                $application->offer->save();
            break;

            case Application::STATUS_ACCEPTED:
                // Email to refused candidates
                $other_applications = Application::where('offer_id', $this->application->offer_id)
                    ->where('id', '!=', $this->application->id)
                    ->get();

                foreach ($other_applications as $application) {
                    dispatch((new SendEmailTemplate(config('emails_templates.application.refused'), $application->candidate->user->email, [
                        'user' => $application->candidate->user,
                    ])));
                }

                // Send e-mail to the candidate
                dispatch((new SendEmailTemplate(config('emails_templates.application.accepted'), $this->application->candidate->user->email, [
                    'user' => $this->application->candidate->user,
                ])));

                // Close offer
                $application->offer->status = Offer::STATUS_UNACTIVE;
                $application->offer->save();
            break;
        }

        return true;
    }
}
