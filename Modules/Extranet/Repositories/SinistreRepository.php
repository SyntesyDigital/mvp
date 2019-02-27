<?php

namespace Modules\Extranet\Repositories;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;

use App\Extensions\VeosWsUrl;

class SinistreRepository
{

    public function __construct()
    {
        $this->client = new Client();
    }

    /*
    *   Récupération sinistre
    *   API : [GET] /sinistre/{id}
    *
    *   @return Sinister Object
    */
    public function find($id)
    {
        $response = $this->client->get(VeosWsUrl::get() . 'sinistre/' . $id, [
            'headers' => [
                'Authorization' => "Bearer " . Auth::user()->token
            ]
        ]);

        return json_decode($response->getBody());
    }

    /*
    *   Création sinistre
    *   API : [POST] /sinistre/
    *
    *   @return stdClass
    */
    public function create($data)
    {
        $response = $this->client->post(VeosWsUrl::get() . 'sinistre/', [
            'json' => $data,
            'headers' => [
                'Authorization' => "Bearer " . Auth::user()->token,
            ]
        ]);

        return json_decode($response->getBody());
    }

    /*
    *   Edit sinistre
    *   API : [PUT] /sinistre/id
    *
    *   @return Sinister Object
    */
    public function update($id,$data)
    {
        $response = $this->client->put(VeosWsUrl::get() . 'sinistre/'.$id, [
            'json' => $data,
            'headers' => [
                'Authorization' => "Bearer " . Auth::user()->token,
            ]
        ]);

        return json_decode($response->getBody());
    }

    public function addGarantie($idSin,$data)
    {
        $response = $this->client->post(VeosWsUrl::get() . 'sinistre/'.$idSin.'/garantie', [
            'json' => $data,
            'headers' => [
                'Authorization' => "Bearer " . Auth::user()->token,
            ]
        ]);

        return json_decode($response->getBody());
    }

    public function addProvision($idSin,$data)
    {
        $response = $this->client->post(VeosWsUrl::get() . 'sinistre/'.$idSin.'/provision', [
            'json' => $data,
            'headers' => [
                'Authorization' => "Bearer " . Auth::user()->token,
            ]
        ]);

        return json_decode($response->getBody());
    }

    public function addCost($data)
    {

      $response = $this->client->post(VeosWsUrl::get() . 'encaissement/trt', [
          'json' => $data,
          'headers' => [
              'Authorization' => "Bearer " . Auth::user()->token,
          ]
      ]);

      return json_decode($response->getBody());
    }

}
