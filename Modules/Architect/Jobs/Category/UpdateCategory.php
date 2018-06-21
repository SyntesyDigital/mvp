<?php

namespace Modules\Architect\Jobs\Category;

use Modules\Architect\Http\Requests\Category\UpdateCategoryRequest;

use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\CategoryField;
use Modules\Architect\Entities\Language;

class UpdateCategory
{
    public function __construct(Category $category, $attributes)
    {
        $this->category = $category;

        $fields = collect(Category::FIELDS)
            ->keyBy('identifier')
            ->keys()
            ->toArray();

        $this->attributes = array_only($attributes['fields'], $fields);

    }

    public static function fromRequest(Category $category, UpdateCategoryRequest $request)
    {
        return new self($category, $request->all());
    }

    public function handle()
    {
        $this->category->fields()->delete();

        foreach($this->attributes as $identifier => $field) {
            foreach($field as $languageId => $value) {
                $this->category->fields()->save(new CategoryField([
                    'name' => $identifier,
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'language_id' => $languageId
                ]));
            }
        }

        return $this->category;
    }
}
