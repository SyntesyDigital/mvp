<?php

namespace Modules\Architect\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Architect\Entities\Language;
use App\Models\Permission;

class ArchitectDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'Català',
            'iso' => 'ca'
        ]);

        Language::create([
            'name' => 'Español',
            'iso' => 'es'
        ]);

        Language::create([
            'name' => 'English',
            'iso' => 'en'
        ]);

        Model::unguard();

    }
}
