<?php

namespace Modules\Extranet\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Carbon\Carbon;


class ModelValuesFormatTransformer extends Resource
{
    protected $element;

    public function __construct($modelValues,$elementFields,$limit) {
        $this->modelValues = $modelValues;
        $this->elementFields = $elementFields;
        $this->limit = $limit;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request = null)
    {
        return $this->getSurveyArray($this->modelValues,$this->elementFields, $this->limit);
    }

    public function toJson($request = null)
    {
      return json_encode($this->toArray($request));
    }

    public function getSurveyArray($modelValues, $elementFields, $limit)
    {

      $result = [];
      $i = 0;
      $isTable = false;

      if(sizeof($modelValues) > 1){
        $isTable = true;
      }

      foreach ($modelValues as $modelValue) {
        if(!$limit || $i < $limit ){
          foreach ($elementFields as $elementField) {
            $originalValue = $modelValue->{$elementField->identifier};

            switch ($elementField->type) {
              case 'number':
                if($elementField->settings['format'] == 'price'){
                  $result[$i][$elementField->identifier] = number_format ( $originalValue , 0 , ',' , '.' ).' €';
                }elseif($elementField->settings['format'] == 'price_with_decimals'){
                  $result[$i][$elementField->identifier] = number_format ( $originalValue , 2 , ',' , '.' ).' €';
                }else{
                  $result[$i][$elementField->identifier] = $originalValue !== null?$originalValue:'';
                }
                break;
              case 'text':
                if($elementField->settings['format'] == 'email'){
                  $result[$i][$elementField->identifier] = $originalValue?$originalValue:'';
                }elseif($elementField->settings['format'] == 'telephone'){
                  $result[$i][$elementField->identifier] = $originalValue?$originalValue:'';
                }else{
                  $result[$i][$elementField->identifier] = $originalValue?$originalValue:'';
                }
                break;
              case 'date':

                $originalValue = intval($originalValue)/1000;
                $result[$i][$elementField->identifier] = $originalValue ? $originalValue: '';

                //only process date when is not table. At tables date is processed in react to sort properly
                if(!$isTable){

                  if($elementField->settings['format'] == 'day_month_year'){
                    $result[$i][$elementField->identifier] = Carbon::createFromTimestamp($originalValue)->format('d-m-Y');
                  }elseif($elementField->settings['format'] == 'month_year'){
                    $result[$i][$elementField->identifier] = Carbon::createFromTimestamp($originalValue)->format('m-Y');
                  }elseif($elementField->settings['format'] == 'year'){
                    $result[$i][$elementField->identifier] = Carbon::createFromTimestamp($originalValue)->format('Y');
                  }
                }

                break;

              default:
                $result[$i][$elementField->identifier] = $originalValue?$originalValue:'';
                break;
            }
          }
        }
        $i++;
      }
      return $result;
    }

}
