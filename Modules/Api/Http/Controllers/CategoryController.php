<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Category;
use Modules\Architect\Ressources\ContentCollection;
use Modules\Architect\Ressources\CategoryCollection;
use Modules\Architect\Ressources\CategoryTreeCollection;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $typologyId = $request->get('typology_id');
        $size = $request->get('size') ? $request->get('size') : 20;

        // FIXME : optimize-it ?
        $collection = Category::with('contents');

        if($typologyId) {
            $collection->whereHas('contents', function($q) use($typologyId) {
                $q->where('contents.typology_id', $typologyId);
            });
        }

        return new CategoryCollection($collection->paginate($size));
    }

    public function tree(Request $request)
    {
        $categoryId = $request->get('category_id');
        $typologyId = $request->get('typology_id');

        $collection = Category::with('descendants', 'contents', 'descendants.contents')
            ->byId($categoryId)
            ->byTypologyId($typologyId);

        // Add automaticly descendants on request parameters
        $loads = explode(',', $request->get('loads'));
        $loads[] = 'descendants';
        $request->merge([
            'loads' => implode(',',$loads)
        ]);

        return new CategoryTreeCollection($collection->get()->toTree());
    }

}
