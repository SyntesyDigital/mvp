<?php

namespace Modules\Architect\Jobs\Category;

use Modules\Architect\Http\Requests\Category\CreateCategoryRequest;

use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\CategoryField;
use Modules\Architect\Entities\Language;

class CreateCategory
{
    public function __construct($attributes)
    {
        $fields = collect(Category::FIELDS)
            ->keyBy('identifier')
            ->keys()
            ->toArray();

        $this->attributes = array_only($attributes['fields'], $fields);
    }

    public static function fromRequest(CreateCategoryRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $category = Category::create([]);

        foreach($this->attributes as $identifier => $field) {
            foreach($field as $languageId => $value) {
                $category->fields()->save(new CategoryField([
                    'name' => $identifier,
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'language_id' => $languageId
                ]));
            }
        }
    }
}
