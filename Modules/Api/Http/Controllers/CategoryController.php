<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Category;
use Modules\Architect\Ressources\ContentCollection;
use Modules\Architect\Ressources\CategoryCollection;

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

}
