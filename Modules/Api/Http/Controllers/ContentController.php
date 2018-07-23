<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\Content;
use Modules\Architect\Ressources\ContentCollection;

class ContentController extends Controller
{
    public function get(Request $request)
    {
        $typologyId = $request->get('typology_id');
        $categoryId = $request->get('category_id');

        $collection = Content::with('fields')->where('id', 1);

        if($typologyId) {
            $collection->where('typology_id', $typologyId);
        }

        if($categoryId) {
            $collection->whereHas('categories', function($q) use($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        return new ContentCollection($collection->paginate(20));
    }


}
