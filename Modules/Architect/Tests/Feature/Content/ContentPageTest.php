<?php

namespace Modules\Architect\Tests\Feature\Content;

use Modules\Architect\Tests\TestCase;

use Modules\Architect\Repositories\ContentRepository;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Language;

use App\Models\User;

use Modules\Architect\Jobs\Typology\CreateTypology;
use Modules\Architect\Jobs\Typology\UpdateTypology;

use Modules\Architect\Jobs\Content\CreateContent;
use Modules\Architect\Jobs\Content\UpdateContent;
use Modules\Architect\Jobs\Content\DeleteContent;

use Modules\Architect\Jobs\Category\CreateCategory;
use Modules\Architect\Jobs\Category\UpdateCategory;

class ContentPageTest extends TestCase
{

    private $attributes = [

        'page' => [
            'status' => 0,
            'typology_id' => null,
            'author_id' => null,
            'is_page' => true,
            'definition' => [],
            'translations' => [
                'es' => true,
                'en' => true,
                'ca' => true,
            ],
            'fields' => [

                [
                    'identifier' => 'title',
                    'type' => 'text',
                    'value' => [
                        'es' => 'Mi pagina (Spanish)',
                        'en' => 'My page (English)',
                        'ca' => 'Mi pagine (Catala)'
                    ]
                ],

                [
                    'identifier' => 'slug',
                    'type' => 'slug',
                    'value' => [
                        'es' => 'mi-pagina-spanish',
                        'en' => 'my-page-english',
                        'ca' => 'mi-pagine-catala'
                    ]
                ],


                [
                    'identifier' => 'description',
                    'type' => 'richtext',
                    'value' => [
                        'es' => 'Lorem ipsum...',
                        'en' => 'Lorem ipsum...',
                        'ca' => 'Lorem ipsum...',
                    ]
                ],
            ]
        ]
    ];

    /*
     *  Create Page
     */
    public function createPage($attributes = null)
    {
        $attributes = $attributes ? $attributes : $this->attributes['page'];

        $attributes['typology_id'] = null;
        $attributes['author_id'] = User::first()->id;

        return (new CreateContent($attributes))->handle();
    }

    /*
     *  [TEST] Creating page
     */
    public function testCreatePage()
    {
        // 1. Create Page
        $this->createPage();

        // 2. Test if content is created
        $this->assertTrue(Content::first() ? true : false);
    }


    /*
     *  [TEST] When we remove parent page
     */
    public function testRemoveParentPage()
    {
        // 1. Create Page 1
        $page1 = $this->createPage();

        // 2. Create Page 2
        $attributes = $this->attributes['page'];
        $attributes['parent_id'] = $page1->id;
        $this->createPage($attributes);

        // 3. Remove page 1
        (new DeleteContent($page1))->handle();

        $page2 = Content::find(2);

        // 4. Test if content is created
        $this->assertTrue($page2->parent_id == $page1->id ? false : true);

        // 5. Test URLS
        foreach($page2->urls as $url) {
            $language = Language::find($url->language_id);

            $actual = $url->url;

            $excepted = sprintf('/%s/%s',
                $language->iso,
                $attributes['fields'][1]['value'][$language->iso]
            );

            $message = '--> BAD URL  : ' . $actual . ' must be ' . $excepted;

            $this->assertSame($excepted, $actual, $message);
        }

    }


}