<?php

namespace Modules\Extranet\Jobs\EmailTemplate;

use Modules\Extranet\Http\Requests\Admin\EmailTemplate\UpdateEmailTemplateRequest;
use Modules\Extranet\Entities\EmailTemplate;

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
        return $this->template->update($this->attributes);
    }
}
