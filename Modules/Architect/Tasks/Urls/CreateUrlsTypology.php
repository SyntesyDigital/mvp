<?php

namespace Modules\Architect\Tasks\Urls;

use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Language;
use Modules\Architect\Entities\Url;

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
            $url = $typology->getFullSlug($language->id);

            if($url) {
                $typology->urls()->create([
                    'language_id' => $language->id,
                    'url' => '/' . $language->iso . $url
                ]);
            }
        });
    }

}
