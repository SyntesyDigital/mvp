<?php

namespace Modules\RRHH\Jobs\EmailTemplate;

use Modules\RRHH\Entities\EmailTemplate;

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
