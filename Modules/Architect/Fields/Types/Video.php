<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;

class Video extends Field implements FieldInterface
{
    public $type = 'video';
    public $icon = 'fa-video-camera';
    public $name = 'VIDEO';

    public $rules = [
        'required'
    ];

    public $settings = [];

    public function validate($request)
    {}

    public function save($content, $identifier, $values, $languages = null)
    {
        return parent::save($content, $identifier, $values, $languages);
    }

}
?>
