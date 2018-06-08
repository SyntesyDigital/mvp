<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;

class Contents extends Field implements FieldInterface
{
    public $type = 'contents';
    public $icon = 'fa-file-o';
    public $name = 'CONTENTS';

    public $rules = [
        'required'
    ];

    public $settings = [
        'only_formats'
    ];
}
?>
