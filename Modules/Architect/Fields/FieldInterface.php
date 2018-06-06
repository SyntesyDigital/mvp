<?php
namespace Modules\Architect\Fields;

use Modules\Architect\Entities\Content;

interface FieldInterface
{
    //public $type;

    public function validate($request);

    public function save($content, $identifier, $values, $languages = null);

    public function getRules();
}

?>
