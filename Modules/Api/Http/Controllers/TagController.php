<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\Tag;
use Modules\Architect\Ressources\TagCollection;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $typologyId = $request->get('typology_id');
        $size = $request->get('size') ? $request->get('size') : 20;

        // FIXME : optimize-it ?
        $collection = Tag::with('contents');

        if($typologyId) {
            $collection->whereHas('contents', function($q) use($typologyId) {
                $q->where('contents.typology_id', $typologyId);
            });
        }

        return new TagCollection($collection->paginate($size));
    }

}
