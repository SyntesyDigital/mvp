<?php

namespace Modules\ExternalApi\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Modules\ExternalApi\Entities\Company;
use Modules\ExternalApi\Entities\Axe;
use Modules\ExternalApi\Entities\Indicator;

use Modules\ExternalApi\Entities\Member;
use Modules\ExternalApi\Entities\Program;
use Modules\ExternalApi\Entities\ProgramCategory;

use Modules\ExternalApi\Entities\AgencyCategory;
use Modules\ExternalApi\Entities\Agency;


class ExternalApiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$faker = Faker\Factory::create('es_ES');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('turismobcn_external.members')->delete();
        DB::table('turismobcn_external.members_programs')->delete();
        DB::table('turismobcn_external.programs')->delete();
        DB::table('turismobcn_external.programs_categories')->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Programs and Members
        for($i = 0; $i < 10; $i++) {
            $member = Member::create([
                'code' => $i,
                'name' => "Member ".$i,
                'address' => "sdfsdf",
                'postcode' => "sdfsdf",
                'city' => 'safd',
                'phone_number' => '234234',
                'email' => "sdfsd@sdf.com",
                'logo' => 'http://wifivox.com/wp-content/themes/wifivox/assets/img/footer/footer-logo-1.jpg'
            ]);

            $program = Program::create([
              'code' => $i,
              'description_ca' => 'Program description_ca '.$i,
              'description_es' => 'Program description_es '.$i,
              'description_en'=> 'Program description_en '.$i
            ]);

            for($j = 0; $j < 3; $j++) {

              $category = ProgramCategory::create([
                'code' => $i.$j,
                'program_id' => $program->id,
                'description_ca' => 'Category description_ca '.$i.'-'.$j,
                'description_es' => 'Category description_es '.$i.'-'.$j,
                'description_en'=> 'Category description_en '.$i.'-'.$j
              ]);

              DB::table('turismobcn_external.members_programs')->insert([
                 'program_id' => $program->id,
                 'category_id' => $category->id,
                 'member_id' => $member->id
             ]);

            }

        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('turismobcn_external.axes')->delete();
        DB::table('turismobcn_external.indicators')->delete();
        DB::table('turismobcn_external.entities')->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Create BST
        for($i = 0; $i < 5; $i++) {
          $axe = Axe::create([
              'id_axe' => $i,
              'description_ca' => 'Axe '.$i,
              'description_es' => 'Axe '.$i,
              'description_en'=> 'Axe '.$i
          ]);

          for($j = 0; $j < 3; $j++) {

            $indicator = Indicator::create([
              'id_axe' => $i,
              'indicator_id' => $i.$j,
              'description_ca' => 'Indicator description_ca '.$i.'-'.$j,
              'description_es' => 'Indicator description_es '.$i.'-'.$j,
              'description_en'=> 'Indicator description_en '.$i.'-'.$j
            ]);

            $company = Company::create([
              'indicator_id' => $i.$j,
              'name' => 'ADFO-CET '.$i.'-'.$j,
              'description_ca' => 'Empresa social que trabaja para conseguir la integración laboral de las personas con
discapacidad física severa. Ofrecen servicios de telemarketing y secretariado. '.$i.'-'.$j,
              'description_es' => 'Empresa social que trabaja para conseguir la integración laboral de las personas con
discapacidad física severa. Ofrecen servicios de telemarketing y secretariado. '.$i.'-'.$j,
              'description_en'=> 'Empresa social que trabaja para conseguir la integración laboral de las personas con
discapacidad física severa. Ofrecen servicios de telemarketing y secretariado. '.$i.'-'.$j,
              'address' => 'Sant Pere 9 baixos',
              'postcode' => '08500',
              'web' => 'www.web.cat'
            ]);

          }

        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('turismobcn_external.agencies')->delete();
        DB::table('turismobcn_external.agencies_categories')->delete();
        DB::table('turismobcn_external.agencies_categories_pivot')->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Create AAVV
        for($i = 0; $i < 5; $i++) {
          $agencyCategory = AgencyCategory::create([
            'name' => 'Category '.$i,
            'description_ca' => 'Description description_ca '.$i,
            'description_es' => 'Description description_es '.$i,
            'description_en'=> 'Description description_en '.$i,
          ]);

          for($j = 0; $j < 3; $j++) {
            $agency = Agency::create([
              'code' => $i.$j,
              'name' => 'Agency '.$i.'-'.$j,
              'address' => "sdfsdf",
              'postcode' => "sdfsdf",
              'city' => 'safd',
              'country' => 'country',
              'phone_number' => '234234',
              'email' => "sdfsd@sdf.com"
            ]);

            DB::table('turismobcn_external.agencies_categories_pivot')->insert([
               'agency_id' => $agency->id,
               'category_id' => $agencyCategory->id
           ]);

          }

        }
    }
}
