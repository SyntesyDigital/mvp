<?php

namespace Modules\Architect\Tasks\Urls;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\Language;
use Modules\Architect\Entities\Url;

class CreateUrlsContent
{
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function run()
    {
        return $this->content->is_page ? $this->createPageUrl() : $this->createContentUrl();
    }

    private function createPageUrl()
    {

        return false;
    }

    /*
     *  Build content url and save it
     *
     *  URLs schema :
     *      - Content with typology : /{typology_slug}/{content_slug}
     *      - Content with typology & category : /{typology_slug}/{category_slug}/../{content_slug}
     */
    private function createContentUrl()
    {
        $content = $this->content;

        if(!$content->typology->has_slug) {
            return false;
        }

        // Prepare array of urls indexed with language ID and Typology Slug
        $urls = Language::all()->mapWithKeys(function($language) use ($content) {
            $typologySlug = $this->content->typology->attrs
                ->where('name', 'slug')
                ->where('language_id', $language->id)
                ->first();

                //  '/' . (isset($typologySlug->value) ? $typologySlug->value : null)
            return [
                $language->id => '/' . $language->iso
            ];
        })->toArray();


        if($this->content->typology->has_categories) {
            foreach($urls as $languageId => $url) {
                $urls[$languageId] .= $this->content->categories->first()->getFullSlug($languageId);
            }
        }

        foreach($urls as $languageId => $url) {
            $content->urls()->create([
                'language_id' => $languageId,
                'url' => $url,
            ]);
        }

        return false;
    }
}
