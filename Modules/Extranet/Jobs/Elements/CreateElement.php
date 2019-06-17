<?php
namespace Modules\Extranet\Jobs\Element;

use Modules\Extranet\Http\Requests\Elements\CreateElementRequest;
use Modules\Extranet\Entities\Element;
use Modules\Extranet\Entities\ElementField;

use Config;
use Carbon\Carbon;

class CreateElement
{
  //  use FormFields;

    public function __construct($attributes)
    {
      $this->attributes = array_only($attributes, [
          'name',
          'identifier',
          'fields',
          'icon',
          'wsModelIdentifier',
          'elementType',
          'has_parameters'
      ]);
    }

    public static function fromRequest(CreateElementRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {

      $element = Element::create([
        'identifier' => $this->attributes['identifier'],
        'name' => $this->attributes['name'],
        'icon' => isset($this->attributes["icon"]) ? $this->attributes["icon"] : null,
        'model_ws' => isset($this->attributes["wsModelIdentifier"]) ? $this->attributes["wsModelIdentifier"] : null,
        'type' => isset($this->attributes["elementType"]) ? $this->attributes["elementType"] : null,
        //'has_parameters'
      ]);

      foreach($this->attributes["fields"] as $field) {
          $element->fields()->save(new ElementField([
              'icon' => $field['icon'],
              'name' => $field['name'],
              'identifier' => $field['identifier'],
              'type' => $field['type'],
              'rules' => isset($field['rules']) ? $field['rules'] : null,
              'settings' => $field['settings'],
              //boby????
          ]));
      }

//      (new CreateUrlsTypology($typology))->run();

      return $element;
    }
}
