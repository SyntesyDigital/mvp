<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Http\Requests\Candidate\SpontaniousRequest;
use Modules\RRHH\Jobs\SendEmailTemplate;
use Modules\RRHH\Entities\Agence;
use Modules\RRHH\Entities\Offers\Application;
use Auth;

class CreateSpontaniousCandidature
{
    public function __construct(SpontaniousRequest $request)
    {
        $this->request = $request;
    }

    public static function fromRequest(SpontaniousRequest $request)
    {
        return new self($request);
    }

    public function handle()
    {
        // dd($this->request->all());
        if (Auth::check()) {
            $candidate = dispatch_now(new UpdateCandidate(Auth::user(), $this->request->all()));
        } else {
            $candidate = dispatch_now(new RegisterCandidate($this->request->all(), false));
        }

        if (null != $this->request->file('resume_file')) {
            $filePath = $this->request->file('resume_file')->store('public/candidates');
            if ($filePath) {
                $candidate->resume_file = str_replace('public/candidates/', '', $filePath);
                $candidate->save();
            } else {
                throw new \Exception('Une erreur s\'est produite lors de l\'enregistrement du C.V');
            }
        }

        $application = Application::where('type', Application::TYPE_SPONTANEOUS)
            ->where('candidate_id', $candidate->id)
            ->first();

        $file = [
            'path' => storage_path('app/public/candidates/'.$candidate->resume_file),
            'name' => 'CV.'.pathinfo($candidate->resume_file, PATHINFO_EXTENSION),
        ];
        $data = [
            'name' => $this->request->firstname,
            'lastname' => $this->request->lastname,
            'message' => $this->request->message,
        ];

        if (0 == $this->request->agence) {
            $agences = Agence::get();
            foreach ($agences as $agence) {
                dispatch((new SendEmailTemplate('APPLICATION_SPONTATINIOUS_RECEIVED_RECRUITER', $agence->email, $data, $file)));
            }
        } else {
            $agence = Agence::where('id', $this->request->agence)->first();
            dispatch((new SendEmailTemplate('APPLICATION_SPONTATINIOUS_RECEIVED_RECRUITER', $agence->email, $data, $file)));
        }

        if ($application) {
            return $application;
        }

        return Application::create([
            'offer_id' => null,
            'candidate_id' => $candidate->id,
            'status' => Application::STATUS_PENDING,
            'type' => Application::TYPE_SPONTANEOUS,
            'done_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
