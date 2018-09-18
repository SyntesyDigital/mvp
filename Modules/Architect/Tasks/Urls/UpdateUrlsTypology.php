<?php

namespace Modules\Architect\Tasks\Urls;

use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Language;
use Modules\Architect\Entities\Url;

use Modules\Architect\Tasks\Urls\UpdateUrlsContent;

class UpdateUrlsTypology
{
    public function __construct(Typology $typology)
    {
        $this->typology = $typology;
    }

    public function run()
    {
        $typology = $this->typology;

        if(!$typology->has_slug) {
            return false;
        }

        $typology->urls()->delete();

        // Create Typology URL
        Language::all()->map(function($language) use ($typology) {
            $attr = $typology->attrs->where('name', 'slug')
                ->where('language_id', $language->id)
                ->first();

            $url = isset($attr->value) ? '/' . $attr->value : null;

            if($url) {
                $typology->urls()->create([
                    'language_id' => $language->id,
                    'url' => '/' . $language->iso . $url
                ]);
            }
        });

        $this->typology->contents->map(function($content) {
            (new UpdateUrlsContent($content))->run();
        });
    }

}
