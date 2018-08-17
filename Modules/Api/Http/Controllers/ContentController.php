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

use Modules\Api\Repositories\ContentRepository;
use DB;

class ContentController extends Controller
{

    public function __construct(ContentRepository $contents)
    {
        $this->contents = $contents;
    }

    public function index(Request $request)
    {
        $typologyId = $request->get('typology_id');
        $categoryId = $request->get('category_id');
        $acceptLang = $request->get('accept_lang');
        $tags = $request->get('tags') ? json_decode($request->get('tags'), true) : null;
        $fields = $request->get('fields') ? json_decode($request->get('fields')) : null;
        $order = $request->get('order');
        $size = $request->get('size') ? $request->get('size') : 20;

        $collection = Content::with('fields')
            ->isNotPage()
            ->isPublished()
            ->typologyId($typologyId)
            ->categoryId($categoryId)
            ->languageIso($acceptLang)
            ->whereFields($fields)
            ->byTagsIds($tags);

        if($order) {
            $order = explode(",", $order);

            if(sizeof($order) > 1) {
                $collection->orderByField($order[0], $order[1]);
            }
        }

        return new ContentCollection($collection->paginate($size));
    }

}
