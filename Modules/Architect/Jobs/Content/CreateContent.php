<?php

namespace Modules\Architect\Jobs\Content;

use Modules\Architect\Http\Requests\Content\CreateContentRequest;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class CreateContent
{

    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'status',
            'typology_id',
            'author_id',
            'fields'
        ]);
    }

    public static function fromRequest(CreateContentRequest $request)
    {
        return new self($request->all());
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = Content::create([
            'status' => $this->attributes['status'] ? $this->attributes['status'] : 0,
            'typology_id' => $this->attributes['typology_id'],
            'author_id' => $this->attributes['author_id'],
        ]);

        $languages = Language::all();

        foreach($this->attributes["fields"] as $field) {
            if(!is_array($field["values"])) {
                $content->fields()->save(new ContentField([
                    'name' => $field["identifier"],
                    'value' => $field["values"]
                ]));
            } else {
                foreach($field["values"] as $iso => $value) {

                    $language = $languages->map(function($language) use ($iso){
                        if($iso == $language->iso) {
                            return $language;
                        }
                        return false;
                    })->first();

                    if($language) {
                        $content->fields()->save(new ContentField([
                            'name' => $field["identifier"],
                            'value' => $value,
                            'language_id' => $language->id
                        ]));
                    }

                }
            }
        }

        return $content;
    }
}
