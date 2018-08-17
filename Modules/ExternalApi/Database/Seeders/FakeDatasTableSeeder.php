<?php

namespace Modules\ExternalApi\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ExternalApi\Entities\Company;

class FakeDatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $faker = Faker\Factory::create();

        // Create companies
        foreach($i = 0; $i < 30; $i++) {
            Company::create([
                'name' => $faker->company,
                'description_ca' => $faker->sentences,
                'description_es' => $faker->sentences,
                'description_en' => $faker->sentences,
                'address' => $faker->address,
                'postcode' => "XXXX",
                'web' => 'XXX'
            ]);

        }


    }
}
