<?php

use Illuminate\Database\Seeder;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\ContentAttribut;
use Modules\Architect\Entities\Language;

class ChrysalySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        // --------------------------------------------- //
        //      CHRYSALY SEEDING
        // --------------------------------------------- //

        // Builds products
        for($i = 0; $i < 100; $i++) {
            $content = Content::create([
                'status' => 1,
                'typology_id' => 3,
                'user_id' => 1
            ]);

            ContentAttribut::create([
                'content_id' => $content->id,
                'name' => 'category',
                'value' => 5
            ]);

            foreach(['fr', 'es', 'en'] as $iso) {
                $language = Language::where('iso', $iso)->first();

                ContentField::create([
                    'content_id' => $content->id,
                    'name' => 'title',
                    'value' => $faker->name,
                    'language_id' => $language->id
                ]);

                ContentField::create([
                    'content_id' => $content->id,
                    'name' => 'slug',
                    'value' => 'elise_' . $content->id,
                    'language_id' => $language->id
                ]);

                ContentField::create([
                    'content_id' => $content->id,
                    'name' => 'description',
                    'value' => $faker->text,
                    'language_id' => $language->id
                ]);

                ContentField::create([
                    'content_id' => $content->id,
                    'name' => 'images',
                    'value' => '["{\"file\":\"adJB79ntGI24wAFUZ2FJNfCKeOs0grkzBIkim0jX.jpeg\",\"title\":\"\"}","{\"file\":\"rnrazW772Otx59UHx6W0M7c19KeITJuyYLryRV1f.jpeg\",\"title\":\"\"}","{\"file\":\"Cajke1TgqHa7xjMlYD06da1j3jOyGKtNVj0Pdd7h.jpeg\",\"title\":\"\"}","{\"file\":\"E9ZNnTdGT8IlxaGgCvs0L41zb6MIkaWNU8geJ7Ii.jpeg\",\"title\":\"tittr\",\"resume\":\"desc\"}"]',
                    'language_id' => $language->id
                ]);

                ContentField::create([
                    'content_id' => $content->id,
                    'name' => 'thumbnail',
                    'value' => 'rnrazW772Otx59UHx6W0M7c19KeITJuyYLryRV1f.jpeg',
                    'language_id' => $language->id
                ]);
            }

        }


    }
}
