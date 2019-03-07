<?php

namespace Modules\Extranet\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Repositories\ExtranetModelRepository;
use Modules\Extranet\Repositories\SinistreRepository;

use Modules\Extranet\Transformers\ModelReactTransformer;

use Modules\Extranet\Entities\ExtranetModel;

use Modules\Extranet\Jobs\Sinister\SinistreCreate;

use Modules\Extranet\Http\Requests\Sinister\CreateSinisterRequest;

use Config;
use Illuminate\Http\Request;
use Session;

class ExtranetController extends Controller
{
    public function __construct(ExtranetModelRepository $models, SinistreRepository $sinisters) {
        $this->models = $models;
        $this->sinisters = $sinisters;
        $this->middleware('auth');
    }

    public function index(ExtranetModel $model = null, Request $request)
    {
        return view('extranet::extranet.index',
                    [
                      'models' => $this->models->all(),
                      'model' => $model != null?$model: $this->models->first()
                    ]);
    }

    public function data(Request $request)
    {

    }

    public function create(ExtranetModel $model, Request $request)
    {
        $modelId = $model->id;
        $model = new ModelReactTransformer($this->models->first()->config);

        return view('extranet::extranet.form', [
            'modelForm' => $model->toArray(),
            'modelId' => $modelId
        ]);
    }

    public function store(CreateSinisterRequest $request)
    {
        $modelId = $request->get('model');
        try {
            $sinister = $this->dispatchNow(SinistreCreate::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('extranet.models.show', $sinister);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.models.create',$modelId);
    }

    public function show($extranet_id,Request $request)
    {
      $extranet_id = 11000381; //delete this
      $sinistre = $this->sinisters->find($extranet_id);
      $modelId = $this->models->first()->id; //pongo 1o pq es el primer model pero deberia venir con la indo del sinister
      $model = new ModelReactTransformer($this->models->first()->config);

      // $this var is to fill values on dynamic form
      $sinistre_values = [
          'type'            => $sinistre->type,
          'responsability'  => $sinistre->txResp,
          'nature'      => $sinistre->circonstance,
          'circumstance'      => $sinistre->causeCirconstance,
    //      ''      => $sinistre->dateOuverture,
          'occurrence_date'      => $sinistre->dateSurvenance,
          'declaration_date'      => $sinistre->dateDeclaration,
          'close_date'      => $sinistre->dateCloture,
          // variables from below are needed on form are not being stored on WS (from insurer_number to ref_expert)
          'insurer_number'      => isset($sinistre_values->insurer_number)?$sinistre_values->insurer_number:'',
          'broker_number'      => isset($sinistre_values->broker_number)?$sinistre_values->broker_number:'',
          'customer_reference'      => isset($sinistre_values->customer_reference)?$sinistre_values->customer_reference:'',
          'reassureur_reference'      => isset($sinistre_values->reassureur_reference)?$sinistre_values->reassureur_reference:'',
          'apperteur_reference'      => isset($sinistre_values->apperteur_reference)?$sinistre_values->apperteur_reference:'',
          'ref_expert'      => isset($sinistre_values->ref_expert)?$sinistre_values->ref_expert:''
      ];

      return  view('extranet::extranet.form', [
        'modelForm' => $model->toArray(),
        'modelId' => $modelId,
        'sinistre' => $sinistre,
        'extranet_id' => $extranet_id,
        'sinistre_values' => json_decode(json_encode($sinistre_values), FALSE)
      ]);

    }

  /*  public function show($sinister, Request $request)
    {
        // AQUI HACER EL GET DEL BOBBY PARA OBTENER LOS DATOS DEL SINISTER... TAMBIEN DE ALGUAN FORMA DEBERIAMOS SABER A QUE MODELO PERTENECE O DE MOMENTO CARGARLO A MANO
        return view('extranet::admin.models.form', [
            'form' => Config::get('offers.form'),
            'offer' => $offer,
        ]);
    } */

/*    public function update(Offer $offer, UpdateOfferRequest $request)
    {
        try {
            $offer = $this->dispatchNow(UpdateOffer::fromRequest($offer, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.admin.offers.show', $offer);
    }
    */

    /*

    public function store(CreateOfferRequest $request)
    {
        try {
            $offer = $this->dispatchNow(CreateOffer::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('extranet.admin.offers.show', $offer);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.admin.offers.create');
    }

    public function delete(Offer $offer, DeleteOfferRequest $request)
    {
        $success = false;
        $message = null;

        try {
            if ($this->dispatchNow(DeleteOffer::fromRequest($offer, $request))) {
                $message = 'Offre supprimée avec succès';
                $success = true;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        }

        Session::flash($success ? 'notify_success' : 'notify_error', $message);

        return redirect()->route('extranet.admin.offers.index');
    }

    public function recipients(Request $request)
    {
        return response()->json($this->users->getAllByRoles(['recruiter', 'admin'])->mapWithKeys(function ($item) {
            return [
                $item->id => $item->full_name,
            ];
        }));
    }

    */
}
