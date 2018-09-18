<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\Content;

use Modules\Api\Repositories\ContentRepository;
use Modules\Architect\Ressources\ContentCollection;

class SearchController extends Controller
{

    public function __construct(ContentRepository $contents)
    {
        $this->contents = $contents;
    }

    public function search(Request $request)
    {

        if(!config('architect.elasticsearch.enabled')) {
            return [
                'message' => 'Elasticsearch is not active in you config file (.env)',
                'success' => false
            ];
        }

        $query = $request->get('q') ?: abort(404);
        $size = request('size', 20);
        $order = explode(",", request('order'));

        $typologyId = $request->get('typology_id') ? json_decode($request->get('typology_id'), true) : null;
        $categoryId = $request->get('category_id') ? json_decode($request->get('category_id'), true) : null;
        $tags = $request->get('tags') ? json_decode($request->get('tags'), true) : null;

        $collection = $this->contents
            ->search($query)
            ->isPublished()
            ->typologyId($typologyId)
            ->categoryId($categoryId)
            ->byTagsIds($tags);

        if(sizeof($order) > 1) {
            $collection->orderByField($order[0], $order[1], $request->get('accept_lang'));
        }

        return (new ContentCollection($collection->paginate($size)))->toArray($request, false);
    }

}
