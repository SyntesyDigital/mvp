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

        Language::all()->map(function($language) use ($category) {
            $url = $category->getFullSlug($language->id);

            if($url) {
                $category->urls()->create([
                    'language_id' => $language->id,
                    'url' => '/' . $language->iso . $url
                ]);
            }
        });
    }

}
