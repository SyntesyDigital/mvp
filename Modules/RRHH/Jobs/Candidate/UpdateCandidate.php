<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Http\Requests\Admin\Candidate\CandidateRequest;
use Modules\RRHH\Jobs\User\UpdateUser;
use Modules\RRHH\Entities\Offers\Candidate;
use App\Models\User;

class UpdateCandidate
{
    public function __construct(User $user, array $attributes = [])
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
            'image',

            'tags',
            'tags_edit',  //to check if editing tags,
            'docs_edit',

            'contract_type',
            'salary',
            'important_information'
        ]);
        $this->user = $user;
    }

    public static function fromRequest(User $user, CandidateRequest $request)
    {
        return new self($user, $request->all());
    }

    public function handle()
    {

        //dd($this->attributes);

        $user = dispatch(new UpdateUser($this->user, $this->attributes));
        if (isset($this->attributes['type'])) {
            if (Candidate::TYPE_NORMAL == $this->user->candidate->type && Candidate::TYPE_INTERIM == $this->attributes['type']) {
                $this->user->candidate->registered_at = date('Y-m-d');
            }
            if (Candidate::TYPE_INTERIM == $this->attributes['type']) {
                $this->user->candidate->registration_number = $this->attributes['registration_number'] ? $this->attributes['registration_number'] : '';
            }
        }

        /*
        if ((isset($this->attributes['resume_file']) && $this->user->candidate->resume_file != $this->attributes['resume_file'] && '' != $this->user->candidate->resume_file) || (! isset($this->attributes['resume_file']) && '' != $this->user->candidate->resume_file)) {
            (new DeleteFile($this->user->candidate->resume_file))->handle();
            $this->user->candidate->update([
                'resume_file' => '',
            ]);
        }

        if ((isset($this->attributes['recommendation_letter']) && $this->user->candidate->recommendation_letter != $this->attributes['recommendation_letter'] && '' != $this->user->candidate->recommendation_letter) || (! isset($this->attributes['recommendation_letter']) && '' != $this->user->candidate->recommendation_letter)) {
            (new DeleteFile($this->user->candidate->recommendation_letter))->handle();
            $this->user->candidate->update([
                'recommendation_letter' => '',
            ]);
        }
        */

        if (isset($this->attributes['password']) && null != $this->attributes['password']) {
            $this->user->password = bcrypt($this->attributes['password']);
        }

        if (isset($this->attributes['resume_file'])) {

            if($this->user->candidate->resume_file != $this->attributes['resume_file']){
              (new DeleteFile($this->user->candidate->resume_file))->handle();
            }

            $this->user->candidate->resume_file = $this->attributes['resume_file'] ? $this->attributes['resume_file'] : '';
        }

        if (isset($this->attributes['recommendation_letter'])) {

            if($this->user->candidate->recommendation_letter != $this->attributes['recommendation_letter']){
              (new DeleteFile($this->user->candidate->recommendation_letter))->handle();
            }

            $this->user->candidate->recommendation_letter = $this->attributes['recommendation_letter'] ? $this->attributes['recommendation_letter'] : '';
        }
        if (isset($this->attributes['type'])) {
            $this->user->candidate->type = $this->attributes['type'];
        }
        if (isset($this->attributes['civility'])) {
            $this->user->candidate->civility = $this->attributes['civility'];
        }

        if (isset($this->attributes['address'])) {
            $this->user->candidate->address = $this->attributes['address'];
        }
        if (isset($this->attributes['location'])) {
            $this->user->candidate->location = $this->attributes['location'];
        }
        if (isset($this->attributes['postal_code'])) {
            $this->user->candidate->postal_code = $this->attributes['postal_code'];
        }
        if (isset($this->attributes['country'])) {
            $this->user->candidate->country = $this->attributes['country'];
        }
        if (isset($this->attributes['birthday'])) {
            $date = explode('/', $this->attributes['birthday']);
            $this->user->candidate->birthday = $date[2].'-'.$date[1].'-'.$date[0];
        }
        if (isset($this->attributes['birthplace'])) {
            $this->user->candidate->birthplace = $this->attributes['birthplace'];
        }

        if (isset($this->attributes['message'])) {
            $this->user->candidate->message = $this->attributes['message'];
        }
        if (isset($this->attributes['job_1'])) {
            $this->user->candidate->job_1 = $this->attributes['job_1'];
        }
        if (isset($this->attributes['job_2'])) {
            $this->user->candidate->job_2 = $this->attributes['job_2'];
        }
        if (isset($this->attributes['job_3'])) {
            $this->user->candidate->job_3 = $this->attributes['job_3'];
        }
        if (isset($this->attributes['comment'])) {
            $this->user->candidate->comment = $this->attributes['comment'];
        }
        if (isset($this->attributes['contract_type'])) {
            $this->user->candidate->contract_type = $this->attributes['contract_type'];
        }

        if (isset($this->attributes['salary'])) {
            $this->user->candidate->salary = $this->attributes['salary'];
        }

        if (isset($this->attributes['important_information'])) {
            $this->user->candidate->important_information = $this->attributes['important_information'];
        }

        $this->user->candidate->save();

        if (isset($this->attributes['tags'])) {
          $this->user->candidate->tags()->sync($this->attributes['tags']);
        }
        else if(isset($this->attributes['tags_edit'])) {
          //not tags defined so remove tags
          $this->user->candidate->tags()->detach();
        }

        return $this->user->candidate;
    }
}
