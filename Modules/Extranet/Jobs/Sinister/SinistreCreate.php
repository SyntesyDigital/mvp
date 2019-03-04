<?php

namespace Modules\Extranet\Jobs\Sinister;

use Modules\Extranet\Http\Requests\Sinister\SaveSinisterRequest;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Modules\Extranet\Repositories\SinistreRepository;

use Session;
use Auth;

class SinistreCreate
{
    private $policeId;
    private $attributes;

    public function __construct($policeId,array $attributes = [])
    {
        $this->policeId = $policeId;

        $this->attributes = array_only($attributes, [
          'code_cie', //isset($policy)?$policy->compagnie:''
          'numsoc', //  ''
          'insurer_number',
          'type',
          'occurrence_date',
          'close_date',
          'declaration_date',
          'responsability',
          'nature',
          'circumstance',
          'documents'
        ]);
    }

    public static function fromRequest($policeId,SaveSinisterRequest $request)
    {
        return new SinistreCreate($policeId,$request->all());
    }

    public function handle()
    {
        $data = $this->attributes;

        $sinister = new SinistreRepository();
        $jsonData = [
              "numCie" => '',
              'idPol' => $this->policeId,
              'numSoc' => isset($data['numsoc']) && $data['numsoc']!= ''? $data['numsoc'] : Auth::user()->company->num_soc,
              'mouvement' => 'OUVSIN',
              'motif' => 'OUVSIN',
              'numAuto' => 'O',
              'circonstance' => $data["nature"],
              'txResp' => $data['responsability'],
              'codeCie' => $data['code_cie'],
              'dateOuverture' => date('d/m/Y'),
              'dateSurvenance' => $data["occurrence_date"],
              'dateDeclaration' => $data["declaration_date"],
              'dateCloture' => $data["close_date"],
              'type' => $data["type"],
              'causeCirconstance' => $data['circumstance'],
              'listPer' => [[
                  "idPer"=> '',
                  "categ"=> "ASSURE"
              ]],
              'listInfos' => [
              ]
            ];


        //echo(json_encode($jsonData));
        //exit();

        $createResponse = $sinister->create($jsonData);

        if(isset($createResponse->id)){

          if(isset($data['documents']) && sizeof($data['documents'])){
            foreach($data['documents'] as $document){
              dispatch(new DocumentUpload($createResponse->id,$document));
            }
          }

          return $createResponse->id;
        }

        return null;

    }
}
