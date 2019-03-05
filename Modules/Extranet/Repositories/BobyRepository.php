<?php

namespace Modules\Extranet\Repositories;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Session;

use App\Extensions\VeosWsUrl;
use Illuminate\Support\Facades\Cache;

class BobyRepository
{

    public function __construct()
    {
        $this->client = new Client();
    }

    /*
    public function postQuery($name, $params = null)
    {
        $cacheKey = md5(Auth::user()->role . "_" . $name . json_encode($params));

        if (Cache::has($cacheKey)) {
            $beans = Cache::get($cacheKey);
        } else {
            $response = $this->client->post(VeosWsUrl::get() . 'boBy/list', [
                'json' => ["requests" =>[[
                    "name" => $name,
                    "params" => $params
                ]]],
                'headers' => [
                    'Authorization' => "Bearer " . Session::get('token')
                ]
            ]);

            $result = json_decode($response->getBody());
            if(isset($result->responses[0])) {
                if((isset($result->responses[0]->statusCode)) && $result->responses[0]->statusCode == 1) {
                    throw new \Exception($result->responses[0]->statusMessage);
                }
            }
            $beans = isset($result->responses[0]->beans) ? $result->responses[0]->beans : null;

            Cache::put($cacheKey, $beans, config('cache.time'));
        }

        return $beans;
    }
    */

    public function getQuery($name)
    {
        $cacheKey = md5("getQuery_" . $name);

        //dd(Session::get('token'));

        if (Cache::has($cacheKey) && false) {
            $beans = Cache::get($cacheKey);
        } else {
            $response = $this->client->get(VeosWsUrl::get() . 'boBy/'.$name, [
                'headers' => [
                    'Authorization' => "Bearer " . Session::get('iga_token')
                ]
            ]);

            $result = json_decode($response->getBody());
            $beans = $result->beans;

            Cache::put($cacheKey, $beans, config('cache.time'));
        }

        return $beans;
    }


    public function getIGA()
    {
        $beans = $this->getQuery('WS_EXTSTD_IDA');

        return $beans;
    }

}
