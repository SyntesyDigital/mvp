<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Http\Requests\Candidate\CandidateRequest;
use Modules\RRHH\Jobs\User\CreateUser;
use Modules\RRHH\Entities\Offers\Candidate;

class CreateCandidate
{
    public function __construct(
        array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'civility',
            'resume_file',
            'recommendation_letter',
            'type',
            'registration_number',
            'firstname',
            'lastname',
            'email',
            'telephone',
            'role_id',
            'password',
            'status',
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

    public static function fromRequest(CandidateRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $user = dispatch(new CreateUser(
            $this->attributes['firstname'],
            $this->attributes['lastname'],
            $this->attributes['email'],
            $this->attributes['role_id'],
            $this->attributes['password'],
            $this->attributes['status'],
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
            'resume_file' => $this->attributes['resume_file'] ? $this->attributes['resume_file'] : '',
            'recommendation_letter' => $this->attributes['recommendation_letter'] ? $this->attributes['recommendation_letter'] : '',
            'type' => Candidate::TYPE_NORMAL,
            'registration_number' => '',
            'registered_at' => date('Y-m-d'),
            'address' => isset($this->attributes['address']) ? $this->attributes['address'] : '',
            'location' => isset($this->attributes['location']) ? $this->attributes['location'] : '',
            'postal_code' => isset($this->attributes['postal_code']) ? $this->attributes['postal_code'] : '',
            'country' => isset($this->attributes['country']) ? $this->attributes['country'] : '',
            'birthday' => $date_formated,
            'birthplace' => isset($this->attributes['birthplace']) ? $this->attributes['birthplace'] : '',
            'comment' => isset($this->attributes['comment']) ? $this->attributes['comment'] : '',
        ]);

        $candidate->user()->associate($user);
        $candidate->Save();

        return $candidate;
    }
}
