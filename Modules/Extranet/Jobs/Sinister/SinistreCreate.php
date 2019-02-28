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
          'client_id',
          'code_cie',
          'broker_number',
          'insurer_number',
          'customer_reference',
          'reassureur_reference',
          'apperteur_reference',
          'ref_expert',
          'numsoc',
          'type',
          'occurrence_date',
          'close_date',
          //'damages_others',
          //'damages_insured',
          //'wounded',
          'declaration_date',
          'responsability',
          'nature',
          //'notice_of_termination',
          'circumstance',
          'subsidiary_company',
          'paid_rc',
          'remaining_provision',
          'paid_damages',
          'remaining_provision_damages',
          'pending_recourse',
          'paid_recourse',
          'customer_franchise',
          'idper',
          'garanties',
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
              "numCie" => $data['insurer_number'],
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
                  "idPer"=> $data["idper"],
                  "categ"=> "ASSURE"
              ]],
              'listInfos' => [

              ]
            ];


        if(isset($data["subsidiary_company"]) && $data["subsidiary_company"]){
            $jsonData['listPer'][] = [
              "idPer"=> $data["subsidiary_company"],
              "categ"=> "FILIALE"
            ];
        }

        //echo(json_encode($jsonData));
        //exit();

        $createResponse = $sinister->create($jsonData);

        if(isset($createResponse->id)){

          //if has garanties add them to sinister
          if(isset($data['garanties']) && sizeof($data['garanties'])){
            dispatch(new SinistreCostCreate($createResponse->id,$data['garanties']));
          }

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
