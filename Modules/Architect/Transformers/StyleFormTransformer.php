<?php

namespace Modules\Architect\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Architect\Entities\Media;


class StyleFormTransformer extends Resource
{

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request
   * @return array
   */
  public function toArray($request = null)
  {
      return $this->getStyleFieldsArray($this->resource->fields()->pluck('value','name'));
  }

  public function toJson($request = null)
  {
    return json_encode($this->toArray($request));
  }

  public function getStyleFieldsArray($fields)
  {
    $info = [];
    foreach($fields as $key => $value){
      $styleField = json_decode($value);
      $info[$key] =$styleField;
      if($styleField->type == 'image'){
        $info[$key]->value = Media::find($styleField->value);
      }

    }

    return $info;
  }



}
