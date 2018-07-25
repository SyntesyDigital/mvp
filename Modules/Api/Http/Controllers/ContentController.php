<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\Language;
use Modules\Architect\Ressources\ContentCollection;
use Modules\Architect\Ressources\CategoryCollection;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $typologyId = $request->get('typology_id');
        $categoryId = $request->get('category_id');
        $acceptLang = $request->get('accept_lang');

        $size = $request->get('size') ? $request->get('size') : 20;

        $collection = Content::with('fields')->where('is_page', 0);

        if($typologyId) {
            $collection->where('typology_id', $typologyId);
        }

        if($categoryId) {
            $collection->whereHas('categories', function($q) use($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        if($acceptLang) {
            $language = Language::where('iso', $acceptLang)->first();
            $collection->whereHas('languages', function($q) use($language) {
                $q->where('language_id', $language->id);
            });
        }

        return new ContentCollection($collection->paginate($size));
    }
}
