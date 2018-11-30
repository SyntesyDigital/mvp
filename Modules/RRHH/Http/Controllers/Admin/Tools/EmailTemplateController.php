<?php

namespace Modules\RRHH\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\Tools\EmailTemplate\CreateEmailTemplateRequest;
use Modules\RRHH\Http\Requests\Admin\Tools\EmailTemplate\UpdateEmailTemplateRequest;
use Modules\RRHH\Jobs\Tools\EmailTemplate\CreateEmailTemplate;
use Modules\RRHH\Jobs\Tools\EmailTemplate\DeleteEmailTemplate;
use Modules\RRHH\Jobs\Tools\EmailTemplate\UpdateEmailTemplate;
use Modules\RRHH\Entities\Tools\EmailTemplate;
use Illuminate\Http\Request;
use Session;

class EmailTemplateController extends Controller
{
    public function index(Request $request)
    {
        return view('rrhh::admin.tools.emails-templates.index', [
            'templates' => EmailTemplate::all(),
        ]);
    }

    public function create()
    {
        return view('rrhh::admin.tools.emails-templates.form');
    }

    public function store(CreateEmailTemplateRequest $request)
    {
        try {
            $template = $this->dispatchNow(CreateEmailTemplate::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('admin.tools.emailstemplates.show', $template);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.tools.emailstemplates.create');
    }

    public function show(EmailTemplate $template, Request $request)
    {
        return view('rrhh::admin.tools.emails-templates.form', [
            'template' => $template,
        ]);
    }

    public function update(EmailTemplate $template, UpdateEmailTemplateRequest $request)
    {
        try {
            $this->dispatchNow(UpdateEmailTemplate::fromRequest($template, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.tools.emailstemplates.show', $template);
    }

    public function delete(EmailTemplate $template)
    {
        try {
            $this->dispatchNow(new DeleteEmailTemplate($template));
            Session::flash('notify_success', 'Suppression effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.tools.emailstemplates.index');
    }
}
