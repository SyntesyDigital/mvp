<?php

namespace Modules\RRHH\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\Content\Typology\CreateTypologyRequest;
use Modules\RRHH\Http\Requests\Admin\Content\Typology\UpdateTypologyRequest;
use Modules\RRHH\Jobs\Content\Typology\CreateTypology;
use Modules\RRHH\Jobs\Content\Typology\DeleteTypology;
use Modules\RRHH\Jobs\Content\Typology\UpdateTypology;
use Modules\RRHH\Entities\Content\Typology;
use Illuminate\Http\Request;
use Session;

class TypologyController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.content.typologies.index', [
            'typologies' => Typology::paginate(20),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.content.typologies.form');
    }

    public function store(CreateTypologyRequest $request)
    {
        try {
            $typology = $this->dispatchNow(CreateTypology::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('admin.content.typologies.show', $typology);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.content.typologies.create');
    }

    public function show($id, Request $request)
    {
        return view('admin.content.typologies.form', [
            'typology' => Typology::find($id),
        ]);
    }

    public function update(Typology $typology, UpdateTypologyRequest $request)
    {
        try {
            $this->dispatchNow(UpdateTypology::fromRequest($typology, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.content.typologies.show', $typology);
    }

    public function delete(Typology $typology)
    {
        try {
            $this->dispatchNow(new DeleteTypology($typology));
            Session::flash('notify_success', 'Suppression effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.content.typologies.index');
    }
}
