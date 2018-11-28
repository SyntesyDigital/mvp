<?php

namespace Modules\RRHH\Jobs\Content\Category;

use Modules\RRHH\Http\Requests\Admin\Content\Category\UpdateCategoryRequest;
use Modules\RRHH\Entities\Content\Category;

class UpdateCategory
{
    private $fields = [
        'identifier',
        'parent_id',
        'status',
        'inputs',
        'typology_id',
    ];

    public function __construct(Category $category, array $attributes = [])
    {
        $this->attributes = array_only($attributes, $this->fields);
        $this->category = $category;
    }

    public static function fromRequest($category, UpdateCategoryRequest $request)
    {
        return new self($category, $request->all());
    }

    public function handle()
    {
        $this->category->update(array_only($this->attributes, [
            'identifier',
            'parent_id',
            'status',
            'typology_id',
        ]));

        if ((isset($this->attributes['inputs'])) && sizeof($this->attributes['inputs'])) {
            foreach ($this->attributes['inputs'] as $languageId => $fields) {
                $this->category->saveFields($fields, $languageId);
            }
        }

        return true;
    }
}
