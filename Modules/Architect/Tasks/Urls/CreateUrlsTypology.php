<?php

namespace Modules\Architect\Tasks\Urls;

use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Language;

class CreateUrlsTypology
{
    public function __construct(Typology $typology)
    {
        $this->typology = $typology;
    }

    public function run()
    {
        $typology = $this->typology;

        Language::all()->map(function($language) use ($typology) {
            $slug = $typologytypology->getSlug($language->id);
            if($slug) {
                $typology->urls()->create([
                    'language_id' => $language->id,
                    'url' => '/' . $language->iso . '/' . $slug
                ]);
            }
        });
    }

}
