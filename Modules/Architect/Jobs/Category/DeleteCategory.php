<?php

namespace Modules\Architect\Jobs\Category;

use Modules\Architect\Http\Requests\Category\DeleteCategoryRequest;

use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\CategoryField;
use Modules\Architect\Entities\Language;

class DeleteCategory
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public static function fromRequest(Category $category, DeleteCategoryRequest $request)
    {
        return new self($category);
    }

    public function handle()
    {
        return $this->category->delete();
    }
}
