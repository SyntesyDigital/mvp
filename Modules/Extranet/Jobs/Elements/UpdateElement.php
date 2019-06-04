<?php
namespace Modules\Extranet\Jobs\Element;

use Modules\Extranet\Http\Requests\Elements\UpdateElementRequest;
use Modules\Extranet\Entities\Element;

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
          'identifier'
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
      $this->element->save();

      return $this->element;
    }
}
