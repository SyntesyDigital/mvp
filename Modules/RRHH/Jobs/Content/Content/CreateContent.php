<?php

namespace Modules\RRHH\Jobs\Content\Content;

use Modules\RRHH\Http\Requests\Admin\Content\Content\CreateContentRequest;
use Modules\RRHH\Entities\Content\Content;
use Modules\RRHH\Entities\Content\ContentField;
use Auth;
use Exception;

class CreateContent
{
    private $fields = [
        'inputs',
        'attributes',
        'typology_id',
        'status',
    ];

    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, $this->fields);
    }

    public static function fromRequest(CreateContentRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $content = Content::create([
            'status' => $this->attributes['status'],
            'typology_id' => $this->attributes['typology_id'],
            'user_id' => Auth::user()->id,
        ]);

        // Save all inputs fields
        foreach ($this->attributes['inputs'] as $languageId => $fields) {
            foreach ($fields as $name => $value) {
                $definition = $content->getField($name);
                $type = isset($definition->type) ? $definition->type : null;

                $field = $content->field($name, $languageId);

                $field = $field ? $field : new ContentField([
                    'name' => $name,
                    'language_id' => $languageId,
                ]);
                $field->content_id = $content->id;
                $field->language_id = $languageId;

                switch ($type) {
                    default:
                        $field->value = is_array($field->value) ? json_encode($field->value) : $value;
                    break;
                }

                if (! $field->save()) {
                    throw new Exception('Erreur while saving field '.$name);
                }
            }
        }

        // Save content categories
        $categories = (isset($this->attributes['attributes']['categories'])) && sizeof($this->attributes['attributes']['categories'])
            ? $this->attributes['attributes']['categories']
            : null;

        if ($categories) {
            $content->saveCategories($categories);
        }

        return $content;
    }
}
