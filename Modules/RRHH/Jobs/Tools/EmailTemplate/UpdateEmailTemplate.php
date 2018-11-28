<?php

namespace Modules\RRHH\Jobs\Tools\EmailTemplate;

use Modules\RRHH\Http\Requests\Admin\Tools\EmailTemplate\UpdateEmailTemplateRequest;
use Modules\RRHH\Entities\Tools\EmailTemplate;

class UpdateEmailTemplate
{
    private $fields = [
        'identifier',
        'subject',
        'body',
    ];

    public function __construct(EmailTemplate $template, array $attributes = [])
    {
        $this->attributes = array_only($attributes, $this->fields);
        $this->template = $template;
    }

    public static function fromRequest($template, UpdateEmailTemplateRequest $request)
    {
        return new self($template, $request->all());
    }

    public function handle()
    {
        $this->template->update($this->attributes);

        return true;
    }
}
