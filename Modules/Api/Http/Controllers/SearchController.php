<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Language;

use Modules\Api\Repositories\ContentRepository;
use Modules\Architect\Ressources\ContentCollection;

use Elasticsearch\ClientBuilder;
use Modules\Api\Collections\ContentSearchCollection;

class SearchController extends Controller
{

    public function __construct(ContentRepository $contents)
    {
        $this->contents = $contents;
    }

// {
//     'content' : {....},
//     'title' : '...',
//     'description' : '...',
//     'url' : '...'
// }

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

        $result = $this->query($query);

        $total = $result['hits']['total'];
        $hits = $result['hits']['hits'];

        $ids = array_map(function($hit) {
            return $hit['_id'];
        }, $hits);

        $collection = Content::whereIn('id', $ids)
            ->isPublished()
            ->typologyId($typologyId)
            ->categoryId($categoryId)
            ->byTagsIds($tags);

        if(sizeof($order) > 1) {
            $collection->orderByField($order[0], $order[1], $request->get('accept_lang'));
        }

        return (new ContentSearchCollection($collection->paginate($size)))->toArray($request, $hits);

        // $collection = $this->contents
        //     ->search($query)
        //     ->isPublished()
        //     ->typologyId($typologyId)
        //     ->categoryId($categoryId)
        //     ->byTagsIds($tags);
        //
        // if(sizeof($order) > 1) {
        //     $collection->orderByField($order[0], $order[1], $request->get('accept_lang'));
        // }
        //
        // return (new ContentCollection($collection->paginate($size)))->toArray($request, false);
    }


    public function query($text)
    {
        $client = ClientBuilder::create()
                ->setHosts(config('architect.elasticsearch.hosts'))
                ->setLogger(ClientBuilder::defaultLogger(storage_path('logs/elastic.log')))
                ->build();

        $acceptLang = request('accept_lang', Language::getCurrentLanguage()->iso);

        $params = array(
            'index' => '_all',
            'body' => [
                'query' => [
                    'multi_match' => [
                        "query" => $text,
                        "fields" => ["$acceptLang.*"],
                        "type" => "phrase_prefix"
                    ]
                ],
            ]
        );

        return $client->search($params);
    }

}