<?php

namespace Modules\RRHH\Jobs\Content\Category;

use Modules\RRHH\Entities\Content\Category;

class DeleteCategory
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function handle()
    {
        return $this->category->delete() > 0 ? true : false;
    }
}
