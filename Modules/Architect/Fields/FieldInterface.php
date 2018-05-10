<?php
namespace Modules\Architect\Fields;

interface FieldInterface
{
    public $type;
    
    public function validate(Request $request);

    public function save(Content $content, Request $request);
}

?>
