<?php

namespace Modules\Architect\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Modules\Architect\Repositories\ContentRepository;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Typology;
use App\Models\User;

use Modules\Architect\Jobs\Typology\CreateTypology;

use Modules\Architect\Jobs\Content\CreateContent;
use Modules\Architect\Tasks\Urls\CreateUrlsContent;

use Artisan;

class TasksUrlsTest extends TestCase
{

    public static $setupDatabase = true;

    public function setUp()
    {
        parent::setUp();

        if(self::$setupDatabase)
        {
            $this->setupDatabase();
        }
    }

    public function setupDatabase()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
        self::$setupDatabase = false;
    }

    private function createTypology()
    {
        $attributes = [
            'name' => 'News',
            'identifier' => 'news',
            'icon' => 'fa-puzzle-piece',
            'has_categories' => false,
            'has_tags' => false,
            'has_slug' => true,
            'slug' => [
                'es' => 'noticias',
                'ca' => 'noticies',
                'en' => 'news'
            ],
            'fields' => [
                [
                    'icon' => 'fa-font',
                    'name' => 'Title',
                    'type' => 'text',
                    'identifier' => 'title',
                    'rules' => '{"required":true,"unique":null,"maxCharacters":null,"minCharacters":null}',
                    'settings' => '{"entryTitle":true,"htmlId":null,"htmlClass":null}',
                ],

                [
                    'icon' => 'fa-link',
                    'name' => 'Slug',
                    'type' => 'slug',
                    'identifier' => 'slug',
                    'rules' => '{"required":true,"unique":true}',
                    'settings' => null,
                ],

                [
                    'icon' => 'fa-align-left',
                    'name' => 'Description',
                    'type' => 'richtext',
                    'identifier' => 'description',
                    'rules' => '{"required":null,"maxCharacters":null}',
                    'settings' => '{"fieldHeight":null,"htmlId":null,"htmlClass":null}',
                ]

            ],
        ];

        return (new CreateTypology($attributes))->handle();
    }

    public function testCreateContentUrl()
    {
        // 1. Create typology
        $typology = $this->createTypology();

        // 2. Create Content
        $attributes = [
            'status' => 0,
            'typology_id' => $typology->id,
            'author_id' => User::first()->id,
            'is_page' => false,
            'fields' => [

                [
                    'identifier' => 'title',
                    'type' => 'text',
                    'value' => [
                        'es' => 'Mi articulo (Spanish)',
                        'en' => 'My article (English)',
                        'ca' => 'Mi article (Catala)'
                    ]
                ],

                [
                    'identifier' => 'slug',
                    'type' => 'slug',
                    'value' => [
                        'es' => 'mi-articulo-spanish',
                        'en' => 'my-article-english',
                        'ca' => 'mi-article-catala'
                    ]
                ],


                [
                    'identifier' => 'description',
                    'type' => 'description',
                    'value' => [
                        'es' => 'Lorem ipsum...',
                        'en' => 'Lorem ipsum...',
                        'ca' => 'Lorem ipsum...',
                    ]
                ],

            ]
        ];

        $content = (new CreateContent($attributes))->handle();

    }
}
