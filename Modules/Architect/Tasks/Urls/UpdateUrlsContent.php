<?php

namespace Modules\Architect\Tasks\Urls;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\Language;
use Modules\Architect\Entities\Url;

class UpdateUrlsContent
{
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function run()
    {
        $this->content->urls()->delete();

        return $this->content->is_page ? $this->updatePageUrl() : $this->updateContentUrl();
    }

    /*
     *  Save page URL and descendants URLs of the page
     *
     *  URLs schema :
     *      - Page : /{parent_slug}/../{page_slug}
     */
    private function updatePageUrl()
    {
        $content = $this->content;
        $languages = Language::getAllCached();

        $languages->map(function($language) use ($content) {
            if(in_array($language->id, $content->languages->pluck('id')->toArray())) {
                $slug = $content->getFullSlug($language->id);

                if($slug) {
                    $content->urls()->create([
                        'language_id' => $language->id,
                        'url' => '/' . $language->iso . '/' . $slug,
                    ]);
                }
            }
        });

        $content->descendants->map(function($descendant) use ($content, $languages){
            $descendant->urls()->delete();

            $languages->map(function($language) use ($descendant) {
                if(in_array($language->id, $descendant->languages->pluck('id')->toArray())) {
                    $slug = $descendant->getFullSlug($language->id);

                    if($slug) {
                        $descendant->urls()->create([
                            'language_id' => $language->id,
                            'url' => '/' . $language->iso . '/' . $slug
                        ]);
                    }
                }
            });
        });

        return true;
    }

    /*
     *  Build/save content URL
     *
     *  URLs schema :
     *      - Content with typology : /{typology_slug}/{content_slug}
     *      - Content with typology & category : /{typology_slug}/{category_slug}/../{content_slug}
     */
     private function updateContentUrl()
     {
         $content = $this->content;

         if(!$content->typology->has_slug) {
             return false;
         }

         // Prepare array of urls indexed with language ID and Typology Slug
         $urls = Language::getAllCached()->mapWithKeys(function($language) use ($content) {
             $attr = $this->content->typology->attrs
                 ->where('name', 'slug')
                 ->where('language_id', $language->id)
                 ->first();

             $slug = isset($attr->value) ? $attr->value : null;

             return [
                 $language->id => '/' . $language->iso . '/' . $slug
             ];
         })->toArray();


         // Save category slug by languages
         // if($this->content->typology->has_categories) {
         //     foreach($urls as $languageId => $url) {
         //         $category = $this->content->categories->first();
         //         if($category) {
         //            $urls[$languageId] .= $category->getFullSlug($languageId);
         //         }
         //     }
         // }

         // Save URLs
         foreach($urls as $languageId => $url) {
             $content->urls()->create([
                 'language_id' => $languageId,
                 'url' => $url . '/' . $content->getFieldValue('slug', $languageId),
             ]);
         }

         return true;
     }
}
