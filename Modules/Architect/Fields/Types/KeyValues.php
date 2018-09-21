<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;

class KeyValues extends Field implements FieldInterface
{
    public $type = 'key_values';
    public $icon = 'fa-key';
    public $name = 'KEY_VALUES';

    public $rules = [];

    public $settings = [];

    public function save($content, $identifier, $values, $languages = null)
    {
        foreach($values as $value) {
            /*
            $id = isset($value['id']) ? $value['id'] : null;

            if($id) {
                $content->fields()->save(new ContentField([
                    'name' => $identifier,
                    'value' => $id,
                    'relation' => 'medias'
                ]));
            }
            */
        }

        return true;
    }
}
?>