<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class TitleTextImage
{
    public $type = 'link';
    public $icon = 'fa-link';
    public $name = 'LINK';

    public $fields = [
      [
        "identifier" => "title",
        "type" => Text::type,
        "name" => "Títol"
      ]
      'url'
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
      'htmlId',
      'htmlClass',
      'allowedTypologies'
    ];

    public function validate($request)
    {}

    public function save($content, $identifier, $values, $languages = null)
    {

      foreach( $fields as $field){
          $field->save();
      }

    }

}
?>
