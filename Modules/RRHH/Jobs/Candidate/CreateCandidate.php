<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Http\Requests\Admin\Candidate\CandidateRequest;
use Modules\RRHH\Jobs\User\CreateUser;
use App\Models\Role;
use Modules\RRHH\Entities\Offers\Candidate;

class CreateCandidate
{
    public function __construct(array $attributes = [])
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
            'comment'
        ]);
    }

    public static function fromRequest(CandidateRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $user = (new CreateUser($this->attributes))->handle();
        $role = Role::where("name", "recruiter")->first();

        if(!$role) {
            return false;
        }

        $user->roles()->sync($role->id);

        // Prepare data
        $attributes = $this->attributes;
        $attributes['registered_at'] = date('Y-m-d');
        $attributes['type'] = Candidate::TYPE_NORMAL;
        $attributes['registration_number'] = '';
        $attributes['user_id'] = $user->id;

        if (isset($this->attributes['birthday'])) {
            $date = explode('/', $this->attributes['birthday']);
            $attributes['birthday'] = $date[2].'-'.$date[1].'-'.$date[0];
        }

        // Create candidate
        $candidate = Candidate::create($attributes);


        return $candidate;
    }
}
