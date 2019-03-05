<?php

namespace Modules\Extranet\Jobs\Sinister;

use Modules\Extranet\Http\Requests\Sinister\CreateSinisterRequest;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Modules\Extranet\Repositories\SinistreRepository;

use Session;
use Auth;

class SinistreCreate
{
    private $policeId;
    private $attributes;

    public function __construct(array $attributes = [])
    {

        $this->attributes = array_only($attributes, [
          'code_cie', //isset($policy)?$policy->compagnie:''
          'numsoc', //  ''
          'insurer_number', //esta en form pero no se donde guardarlo en WS
          'broker_number', //esta en form pero no se donde guardarlo en WS
          'customer_reference', //esta en form pero no se donde guardarlo en WS
          'reassureur_reference', //esta en form pero no se donde guardarlo en WS
          'apperteur_reference', //esta en form pero no se donde guardarlo en WS
          'ref_expert', //esta en form pero no se donde guardarlo en WS
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

    public static function fromRequest(CreateSinisterRequest $request)
    {
        return new SinistreCreate($request->all());
    }

    public function handle()
    {
        $data = $this->attributes;

        $sinister = new SinistreRepository();
        $jsonData = [
              'numCie' => '',
              'idPol' => '11000145',
              'numSoc' => 'CI01',
              'mouvement' => 'OUVSIN',
              'motif' => 'EXTSIN',
              'numAuto' => 'O',
              'numAutoCie' =>'',
              'type' => $data["type"],
              'txResp' => $data['responsability'],
              'circonstance' => $data["nature"],
              'causeCirconstance' => $data['circumstance'],
              'dateOuverture' => date('d/m/Y'),
              'dateSurvenance' => $data["occurrence_date"],
              'dateDeclaration' => $data["declaration_date"],
              'dateCloture' => $data["close_date"],
              'dommages'=>'test',
              'codeProduit'=>'AUTO',
              'codeCie' =>"ALZ_CI",
              'libMvt'=>'Ouverture Sinistre',
              'libMotif'=>'Prueba-declaration Extranet',
              'loadAssure'=>'1',
              'listInfos' => [
                 ['key'=>'ALCOOL_STUP','value'=>'S']
              ],
              'risque5'=>'Paris',
              'risque4'=>'23000',
              'cdIda'=>'10'
            ];



        $createResponse = $sinister->create($jsonData);

        if(isset($createResponse->id)){
          return $createResponse->id;
        }

        return null;

    }
}
