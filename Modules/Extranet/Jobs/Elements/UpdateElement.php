<?php
namespace Modules\Extranet\Jobs\Element;

use Modules\Extranet\Http\Requests\Elements\UpdateElementRequest;
use Modules\Extranet\Entities\Element;
use Modules\Extranet\Entities\ElementField;

use Config;
use Carbon\Carbon;

class UpdateElement
{
  //  use FormFields;

    public function __construct(Element $element, array $attributes = [])
    {
      $this->element = $element;
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

    public static function fromRequest(Element $element, UpdateElementRequest $request)
    {
        return new self($element, $request->all());
    }

    public function handle()
    {
      $this->element->name = $this->attributes['name'];
      $this->element->identifier = $this->attributes['identifier'];
      $this->element->icon =$this->attributes["icon"];
      //'has_parameters'
      $this->element->save();

      $this->element->fields()->delete();

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

//      $this->typology->load('fields', 'attrs');
//      (new UpdateUrlsTypology($this->typology))->run();

      return $this->element;
    }
}
