<?php

namespace Modules\Extranet\Repositories;

use Modules\Extranet\Entities\Element;
use Datatables;
use Prettus\Repository\Eloquent\BaseRepository;
use Lang;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Session;
use App\Extensions\VeosWsUrl;
use Config;

class ElementRepository extends BaseRepository
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function model()
    {
        return "Modules\\Extranet\\Entities\Element";
    }

    public function getElementsByType($element_type)
    {
        return Element::where('type',$element_type)->get();
    }

    /*
    *   Récupération models
    *   API : [POST] /boBy/list
    *
    *   @return Models List
    */
    public function GetModelsByType($type)
    {
        $jsonData = [
              'requests' =>  [
                 ['name'=>Element::TYPES[$type]['WS_NAME']]
              ]
            ];

        $response = $this->client->post(VeosWsUrl::get() . 'boBy/list/', [
            'json' => $jsonData,
            'headers' => [
                'Authorization' => "Bearer " . 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJUb2tlbiBBdXRoIiwiaWRQZXIiOiIxMTMzNjIyMyIsImNhdGVnIjoiVVNFUkVYVCIsImlzcyI6InZlb3MyIC0gUkVDRVRURSAtIEFSSUxJTSIsImxhbmd1YWdlIjoiRiIsImV4cCI6MTU1OTY1NTI5MywiaWF0IjoxNTU5NjQ0NDkzfQ.22DQHm8-wp6v0qzefE7v2msB8GM3-4Y5QgsIQzH0TbM',
            ]
        ]);
        return json_decode($response->getBody())->responses[0]->beans;
    }


}
