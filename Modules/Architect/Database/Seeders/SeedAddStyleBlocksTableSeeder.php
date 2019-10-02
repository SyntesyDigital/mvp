<?php

namespace Modules\Architect\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedAddStyleBlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('styles')->insert([
            'identifier' => 'front',
            'icon' => 'fas fa-desktop'
        ]);
        DB::table('styles')->insert([
            'identifier' => 'back',
            'icon' => 'fas fa-user-lock'
        ]);
    }
}
