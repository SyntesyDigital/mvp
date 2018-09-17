<?php

namespace Modules\Api\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Field;
use Modules\Architect\Entities\Language;
use Elasticsearch\ClientBuilder;

class ContentRepository extends BaseRepository
{
    public function model()
    {
        return Content::class;
    }

    public function search($query)
    {
        $client = ClientBuilder::create()
                ->setHosts(config('elasticsearch.hosts'))
                ->setLogger(ClientBuilder::defaultLogger(storage_path('logs/elastic.log')))
                ->build();

        $acceptLang = request('accept_lang', Language::getDefault()->iso);

        $params = array(
            'index' => '*',
            'body' => [
                'query' => [
                    'multi_match' => [
                        "query" => $query,
                        "fields" => ["$acceptLang.*"],
                        "type" => "phrase_prefix"
                    ]
                ]
            ]
        );

        $result = $client->search($params);

        $total = $result['hits']['total'];
        $hits = $result['hits']['hits'];

        $ids = array_map(function($hit) {
            return $hit['_id'];
        }, $hits);

        return Content::whereIn('id', $ids);
    }

}
