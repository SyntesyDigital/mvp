<?php

namespace Modules\Architect\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Role;
use Modules\Architect\Entities\Language;

class ArchitectDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $admin = User::create([
            'email' => 'admin@bar.com',
            'password' => bcrypt('secret'),
            'firstname' => 'Admin',
            'lastname' => 'Admin',
        ]);

        //user
        $userRole = new Role();
        $userRole->name = 'user';
        $userRole->display_name = 'User'; // optional
        $userRole->description = 'User role'; // optional
        $userRole->save();

        //admin
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = 'Admin'; // optional
        $adminRole->description = 'Admin role'; // optional
        $adminRole->save();

        $admin->attachRole($adminRole);

        Language::create([
            'name' => 'Français',
            'iso' => 'fr'
        ]);

        Language::create([
            'name' => 'English',
            'iso' => 'en'
        ]);

        Language::create([
            'name' => 'Español',
            'iso' => 'es'
        ]);

        Language::create([
            'name' => 'Catalan',
            'iso' => 'cat'
        ]);
        // $this->call("OthersTableSeeder");
    }
}
