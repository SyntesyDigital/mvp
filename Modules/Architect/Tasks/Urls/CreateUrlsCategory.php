<?php

namespace Modules\Architect\Tasks\Urls;

use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\Language;
use Modules\Architect\Entities\Url;

class CreateUrlsCategory
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function run()
    {
        $category = $this->category;


        Language::getAllCached()->map(function($language) use ($category) {
            $slug = $category->getFullSlug($language->id);
            $isMultiLanguage = env('ARCHITECT_MULTI_LANGUAGE', true);

            if($slug) {
                $category->urls()->create([
                    'language_id' => $language->id,
                    'url' => $isMultiLanguage
                        ? '/' . $language->iso . '/' . $slug
                        : '/' . $slug
                ]);
            }
        });
    }

}
