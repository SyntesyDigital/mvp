<?php
namespace Modules\Extranet\Jobs\Element;

use Modules\Extranet\Http\Requests\Elements\CreateElementRequest;
use Modules\Extranet\Entities\Element;

use Config;
use Carbon\Carbon;

class CreateElement
{
  //  use FormFields;

    public function __construct($attributes)
    {
      $this->attributes = array_only($attributes, [
          'name',
          'identifier'
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
      ]);
      return $element;
    }
}
