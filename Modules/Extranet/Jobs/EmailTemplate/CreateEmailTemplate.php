<?php

namespace Modules\Extranet\Jobs\EmailTemplate;

use Modules\Extranet\Http\Requests\Admin\EmailTemplate\CreateEmailTemplateRequest;
use Modules\Extranet\Entities\EmailTemplate;

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
