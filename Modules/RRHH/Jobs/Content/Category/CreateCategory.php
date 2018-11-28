<?php

namespace Modules\RRHH\Jobs\Content\Category;

use Modules\RRHH\Http\Requests\Admin\Content\Category\CreateCategoryRequest;
use Modules\RRHH\Entities\Content\Category;

class CreateCategory
{
    private $fields = [
        'identifier',
        'parent_id',
        'status',
        'inputs',
        'typology_id',
    ];

    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, $this->fields);
    }

    public static function fromRequest(CreateCategoryRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $category = Category::create(array_only($this->attributes, [
            'status',
            'parent_id',
            'identifier',
            'typology_id',
        ]));

        foreach ($this->attributes['inputs'] as $languageId => $arr) {
            foreach ($arr as $name => $value) {
                $category->saveField($name, $value, $languageId);
            }
        }

        return $category;
    }
}
