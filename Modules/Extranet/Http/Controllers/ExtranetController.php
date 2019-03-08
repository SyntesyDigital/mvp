<?php

namespace Modules\Extranet\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Repositories\ExtranetModelRepository;
use Modules\Extranet\Repositories\SinistreRepository;
use Modules\Extranet\Repositories\BobyRepository;

use Modules\Extranet\Transformers\ModelReactTransformer;

use Modules\Extranet\Entities\ExtranetModel;

use Modules\Extranet\Jobs\Sinister\SinistreCreate;
use Modules\Extranet\Jobs\Sinister\SinistreUpdate;

use Modules\Extranet\Http\Requests\Sinister\CreateSinisterRequest;

use Config;
use Illuminate\Http\Request;
use Session;

class ExtranetController extends Controller
{
    public function __construct(ExtranetModelRepository $models,
      SinistreRepository $sinisters, BobyRepository $boby) {
        $this->models = $models;
        $this->sinisters = $sinisters;
        $this->boby = $boby;
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

        $modelForm = new ModelReactTransformer($this->models->first()->config);

        return view('extranet::extranet.form', [
            'model' => $model,
            'modelForm' => $modelForm->toArray(),
            'modelId' => $modelId,
            'natures' => $this->boby->getNatures()
        ]);
    }

    public function store(CreateSinisterRequest $request)
    {
        $modelId = $request->get('model');
        try {
            $sinister = $this->dispatchNow(SinistreCreate::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('extranet.extranet.show', $sinister);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.extranet.create',$modelId);
    }

    public function show($sinisterId,Request $request)
    {

      $sinistre = $this->sinisters->find($sinisterId);
      $model = $this->models->first();
      $modelId = $model->id;
      $modelForm = new ModelReactTransformer($this->models->first()->config);

      //process all fields
      $sinistreValues = $this->sinisters->processGet($sinistre);

      return  view('extranet::extranet.form', [
        'model' => $model,
        'modelForm' => $modelForm->toArray(),
        'modelId' => $modelId,
        'natures' => $this->boby->getNatures(),
        'sinistre' => $sinistre,
        'extranet_id' => $sinisterId,
        'sinistre_values' => $sinistreValues
      ]);

    }

    public function update($modelId, CreateSinisterRequest $request)
    {
        try {
            $offer = $this->dispatchNow(SinistreUpdate::fromRequest($modelId, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.extranet.show', $modelId);
    }

}
