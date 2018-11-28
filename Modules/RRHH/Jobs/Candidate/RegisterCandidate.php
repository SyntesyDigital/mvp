<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Http\Requests\Candidate\CandidateFrontRequest;
use Modules\RRHH\Jobs\User\CreateUser;
use Modules\RRHH\Entities\Offers\Candidate;
use Modules\RRHH\Entities\User;
use Auth;
use Illuminate\Support\Str;

class RegisterCandidate
{
    public function __construct(array $attributes = [], $attempt = true)
    {
        $this->attempt = $attempt;
        $this->attributes = array_only($attributes, [
            'civility',
            'firstname',
            'lastname',
            'email',
            'telephone',
            'address',
            'location',
            'postal_code',
            'country',
            'birthday',
            'birthplace',
            'message',
            'job_1',
            'job_2',
            'job_3',
            'comment',
        ]);
    }

    public static function fromRequest(CandidateFrontRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $password = str::random(8);

        $user = dispatch(new CreateUser(
            $this->attributes['firstname'],
            $this->attributes['lastname'],
            $this->attributes['email'],
            4,
            $password,
            User::STATUS_ACTIVE,
            null,
            $this->attributes['telephone']
        ));

        $date_formated = null;
        if (isset($this->attributes['birthday'])) {
            $date = explode('/', $this->attributes['birthday']);
            $date_formated = $date[2].'-'.$date[1].'-'.$date[0];
        }

        $candidate = new Candidate([
            'civility' => $this->attributes['civility'],
            'resume_file' => '',
            'recommendation_letter' => '',
            'type' => Candidate::TYPE_NORMAL,
            'registration_number' => '',
            'registered_at' => date('Y-m-d'),
            'address' => isset($this->attributes['address']) ? $this->attributes['address'] : '',
            'location' => isset($this->attributes['location']) ? $this->attributes['location'] : '',
            'postal_code' => isset($this->attributes['postal_code']) ? $this->attributes['postal_code'] : '',
            'country' => isset($this->attributes['country']) ? $this->attributes['country'] : '',
            'birthday' => $date_formated,
            'birthplace' => isset($this->attributes['birthplace']) ? $this->attributes['birthplace'] : '',
            'message' => isset($this->attributes['message']) ? $this->attributes['message'] : '',
            'job_1' => isset($this->attributes['job_1']) ? $this->attributes['job_1'] : '',
            'job_2' => isset($this->attributes['job_2']) ? $this->attributes['job_2'] : '',
            'job_3' => isset($this->attributes['job_3']) ? $this->attributes['job_3'] : '',
            'comment' => isset($this->attributes['comment']) ? $this->attributes['comment'] : '',
        ]);

        $candidate->user()->associate($user);

        if ($candidate->save()) {
            if ($this->attempt) {
                Auth::attempt([
                    'email' => $this->attributes['email'],
                    'password' => $password,
                ]);
            }

            return $candidate;
        }

        return null;
    }
}
