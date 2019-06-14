<?php

namespace Modules\Extranet\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Repositories\ElementRepository;

use Modules\Extranet\Entities\Element;

use Modules\Extranet\Http\Requests\Elements\CreateElementRequest;
use Modules\Extranet\Http\Requests\Elements\UpdateElementRequest;
use Modules\Extranet\Http\Requests\Elements\DeleteElementRequest;

use Modules\Extranet\Jobs\Element\CreateElement;
use Modules\Extranet\Jobs\Element\UpdateElement;
use Modules\Extranet\Jobs\Element\DeleteElement;


use Config;
use Illuminate\Http\Request;
use Session;

class ElementController extends Controller
{
    public function __construct(ElementRepository $elements) {
        $this->elements = $elements;
    }

    public function index()
    {
        return view('extranet::elements.index');
    }

    public function typeIndex($element_type,Request $request)
    {
        $models = $this->elements->getModelsByType($element_type);

        return view('extranet::elements.type_index',
                [
                  'elements' => $this->elements->getElementsByType($element_type),
                  'models' => $models,
                  'element_type' => $element_type
                ]);
    }

    private function getModelById($models,$modelId){

        foreach($models as $model){
          if($model->ID == $modelId){
            return $model;
          }
        }
        return null;
    }

    public function create($element_type, $model_id, Request $request)
    {
        //get model and fields
        $models = $this->elements->getModelsByType($element_type);
        $model = $this->getModelById($models,$model_id);

        if(!$model)
          abort(500);

        $fields = $this->elements->getFieldsByElement($model->WS);

        $data = [
          'element_type' => $element_type,
          'model' => $model,
          'fields' => $fields
        ];

        if($request->has('debug')){
          dd($data);
        }

        return view('extranet::elements.form', $data);
    }

    public function show(Element $element, Request $request)
    {
        return view('extranet::elements.form',["element" => $element]);
    }

    public function store(CreateElementRequest $request)
    {
      try {
            $element = $this->dispatchNow(CreateElement::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('extranet.elements.show', $element);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.elements.create')->withInput();

    }

    public function update(Element $element, UpdateElementRequest $request)
    {
        try {
            $this->dispatchNow(UpdateElement::fromRequest($element, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.elements.show', $element);
    }

    public function delete(Element $element, DeleteElementRequest $request)
    {
      return dispatch_now(DeleteElement::fromRequest($element, $request)) ? response()->json([
                'success' => true
            ]) : response()->json([
                'success' => false
            ], 500);
    }

}
