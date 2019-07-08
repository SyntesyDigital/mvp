<?php

namespace Modules\Extranet\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Repositories\ElementRepository;

use Modules\Extranet\Entities\Element;
use Modules\Extranet\Entities\RouteParameter;

use Modules\Extranet\Http\Requests\Elements\CreateElementRequest;
use Modules\Extranet\Http\Requests\Elements\UpdateElementRequest;
use Modules\Extranet\Http\Requests\Elements\DeleteElementRequest;

use Modules\Extranet\Jobs\Element\CreateElement;
use Modules\Extranet\Jobs\Element\UpdateElement;
use Modules\Extranet\Jobs\Element\DeleteElement;

use Modules\Extranet\Transformers\ModelValuesFormatTransformer;


use Config;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;


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
        $parametersList = RouteParameter::all();

        $data = [
          'element_type' => $element_type,
          'model' => $model,
          'fields' => $fields,
          'parametersList' => $parametersList
        ];

        if($request->has('debug')){
          dd($data);
        }

        return view('extranet::elements.form', $data);
    }

    public function show(Element $element, Request $request)
    {
      $models = $this->elements->getModelsByType( $element->type);
      $model = $this->getModelById($models,$element->model_identifier);
      $fields = $this->elements->getFieldsByElement($model->WS);
      $parametersList = RouteParameter::all();

      $data = [
        'element_type' => $element->type,
        'model' => $model,
        'fields' => $fields,
        'element' => $element->load('fields','attrs'),
        'parametersList' => $parametersList,
        'parameters' => $element->getParameters()
      ];

        return view('extranet::elements.form',$data);
    }

    public function store(CreateElementRequest $request)
    {
      try {
            $element = $this->dispatchNow(CreateElement::fromRequest($request));
            return response()->json([
                      'success' => true,
                      'element' => $element
                  ]);
        } catch (\Exception $e) {
        }
        return response()->json([
            'success' => false
        ], 500);

    }

    public function update(Element $element, UpdateElementRequest $request)
    {
        try {
              $element = $this->dispatchNow(UpdateElement::fromRequest($element, $request));
              return response()->json([
                        'success' => true,
                        'element' => $element
                    ]);
          } catch (\Exception $e) {
          }
          return response()->json([
              'success' => false
          ], 500);
    }

    public function delete(Element $element, DeleteElementRequest $request)
    {
      return dispatch_now(DeleteElement::fromRequest($element, $request)) ? response()->json([
                'success' => true
            ]) : response()->json([
                'success' => false
            ], 500);
    }


    public function getModelValues(Element $element, $limit = null)
    {

      try {
            $modelValues = $this->elements->getModelValuesFromElement($element);
            return response()->json([
                      'success' => true,
                      'modelValues' => new ModelValuesFormatTransformer($modelValues,$element->fields()->get(), $limit)
                  ]);
        } catch (\Exception $e) {
        }
        return response()->json([
            'success' => false
        ], 500);

    }

    public function export(Element $element, $limit = null, Request $request)
    {
      $modelValues = (new ModelValuesFormatTransformer($this->elements->getModelValuesFromElement($element),$element->fields()->get(), $limit))->toArray();
      $filename =  Carbon::now()->format('YmdHs').'_'.str_slug($element->name, "_").".csv";
      $filepath = storage_path() . "/app/".$filename;
      $handle = fopen($filepath, 'w+');

      $titles = $element->fields()->pluck('name')->toArray();
      $colmuns = $element->fields()->pluck('name','identifier');
      fputcsv($handle, $titles);


      foreach($modelValues as $modelValue){
        $row = [];
        foreach($colmuns as $key => $value) {
          array_push($row,isset($modelValue[$key]) ? $modelValue[$key] : "" );
        }

        fputcsv($handle, $row);
      }

      fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

      return response()->download($filepath, $filename, $headers);

    }

}
