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

    public function getNatures()
    {
        $beans = $this->getQuery('WS_EXTSTD_CIRCONSTANCE?CDPROD=AUTO');

        $data = [];
        foreach($beans as $bean){
          $data[$bean->codeCirconst] = $bean->circonstance;
        }

        return $data;
    }



}
