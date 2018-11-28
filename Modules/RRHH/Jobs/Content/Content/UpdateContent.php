<?php

namespace Modules\RRHH\Jobs\Content\Content;

use Modules\RRHH\Http\Requests\Admin\Content\Content\UpdateContentRequest;
use Modules\RRHH\Entities\Content\Content;
use Modules\RRHH\Entities\Content\ContentField;
use Auth;
use Exception;

class UpdateContent
{
    private $fields = [
        'inputs',
        'attributes',
        'typology_id',
        'status',
    ];

    public function __construct(Content $content, array $attributes = [])
    {
        $this->content = $content;
        $this->attributes = array_only($attributes, $this->fields);
    }

    public static function fromRequest(Content $content, UpdateContentRequest $request)
    {
        return new self($content, $request->all());
    }

    public function handle()
    {
        $this->content->update([
            'status' => $this->attributes['status'],
            'typology_id' => $this->attributes['typology_id'],
            'user_id' => Auth::user()->id,
        ]);

        foreach ($this->attributes['inputs'] as $languageId => $fields) {
            foreach ($fields as $name => $value) {
                $definition = $this->content->getField($name);
                $type = isset($definition->type) ? $definition->type : null;

                $field = $this->content->field($name, $languageId);
                $field = $field ? $field : new ContentField([
                    'name' => $name,
                    'content_id' => $this->content->id,
                    'language_id' => $languageId,
                ]);
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

        $this->content->deleteCategories();
        if ($categories) {
            $this->content->saveCategories($categories);
        }

        return $this->content;
    }
}
