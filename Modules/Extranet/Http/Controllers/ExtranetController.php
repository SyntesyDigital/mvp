<?php

namespace Modules\Extranet\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Repositories\ExtranetModelRepository;
use Modules\Extranet\Transformers\ModelReactTransformer;

use Modules\Extranet\Entities\ExtranetModel;

use Modules\Extranet\Jobs\Sinister\SinistreCreate;

use Modules\Extranet\Http\Requests\Sinister\CreateSinisterRequest;

use Config;
use Illuminate\Http\Request;
use Session;

class ExtranetController extends Controller
{
    public function __construct(ExtranetModelRepository $models) {
        $this->models = $models;
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
