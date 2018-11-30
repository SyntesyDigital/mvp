<?php

use Modules\RRHH\Entities\Offers\Candidate;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = factory(User::class)->make();
        $user->email = 'foo@bar.com';
        $user->save();

      /*  $admin = factory(User::class)->make();
        $admin->email = 'admin@bar.com';
        $admin->save();*/

        $recruiter = factory(User::class)->make();
        $recruiter->email = 'recruiter@bar.com';
        $recruiter->save();

        $candidate = factory(User::class)->make();
        $candidate->email = 'candidate@bar.com';
        $candidate->save();

        $candidateInfo = Candidate::create([
            'user_id' => $candidate->id,
            'civility' => Candidate::CIVILITY_MALE,
            'type' => Candidate::TYPE_NORMAL,
        ]);

        ////////////////////////
        //		Roles
        ////////////////////////

    /*  //user
        $userRole = new Role();
        $userRole->name = 'user';
        $userRole->display_name = 'User'; // optional
        $userRole->description = 'Manager offers & applications'; // optional
        $userRole->save();
*/
        //admin
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = 'Admin'; // optional
        $adminRole->description = 'Superuser of the app'; // optional
        $adminRole->save();

        //recruiter
        $recruiterRole = new Role();
        $recruiterRole->name = 'recruiter';
        $recruiterRole->display_name = 'Recruteur'; // optional
        $recruiterRole->description = 'Recruiter'; // optional
        $recruiterRole->save();

        //candidate
        $candidateRole = new Role();
        $candidateRole->name = 'candidate';
        $candidateRole->display_name = 'Candidate'; // optional
        $candidateRole->description = 'Candidate'; // optional
        $candidateRole->save();

        // role attach alias
    //    $user->attachRole($userRole);
    //    $admin->attachRole($adminRole);
        $recruiter->attachRole($recruiterRole);
        $candidate->attachRole($candidateRole);

        //Candidate part
        $candidate_part = new Candidate([
            'civility' => Candidate::CIVILITY_MALE,
            'resume_file' => '',
            'recommendation_letter' => '',
            'type' => Candidate::TYPE_NORMAL,
            'registration_number' => '',
            'registered_at' => date('Y-m-d'),
        ]);
        $candidate_part->user()->associate($candidate);
        $candidate_part->Save();

        ////////////////////////
        //		Permissions
        ////////////////////////

        /*
        $createPost = new Permission();
        $createPost->name         = 'create-post';
        $createPost->display_name = 'Create Posts'; // optional
        $createPost->description  = 'create new blog posts'; // optional
        $createPost->save();

        //add roles permision to create post
        $adminRole->attachPermission($createPost);
        //$owner->attachPermissions(array($createPost, $editUser));
        */
    }
}
