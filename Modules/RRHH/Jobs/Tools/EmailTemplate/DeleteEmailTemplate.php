<?php

namespace Modules\RRHH\Jobs\Tools\EmailTemplate;

use Modules\RRHH\Entities\Tools\EmailTemplate;

class DeleteEmailTemplate
{
    public function __construct(EmailTemplate $template)
    {
        $this->template = $template;
    }

    public function handle()
    {
        return $this->template->delete() > 0 ? true : false;
    }
}
