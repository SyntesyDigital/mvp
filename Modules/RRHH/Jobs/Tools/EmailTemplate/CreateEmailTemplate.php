<?php

namespace Modules\RRHH\Jobs\Tools\EmailTemplate;

use Modules\RRHH\Http\Requests\Admin\Tools\EmailTemplate\CreateEmailTemplateRequest;
use Modules\RRHH\Entities\Tools\EmailTemplate;

class CreateEmailTemplate
{
    private $fields = [
        'identifier',
        'subject',
        'body',
    ];

    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, $this->fields);
    }

    public static function fromRequest(CreateEmailTemplateRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        return EmailTemplate::create($this->attributes);
    }
}
