<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Agence\AgenceRequest;
use Modules\RRHH\Http\Requests\Agence\CreateFileRequest;
use Modules\RRHH\Jobs\Agence\CreateAgence;
use Modules\RRHH\Jobs\Agence\CreateFile;
use Modules\RRHH\Jobs\Agence\DeleteAgence;
use Modules\RRHH\Jobs\Agence\UpdateAgence;
use Modules\RRHH\Entities\Agence;
/*

use Modules\RRHH\Jobs\Tags\UpdateAgenceTags;
*/
use Modules\RRHH\Repositories\AgenceRepository;
use Illuminate\Http\Request;
use Session;

class AgenceController extends Controller
{
    public function __construct(AgenceRepository $agences)
    {
        $this->agences = $agences;
    }

    public function index(Request $request)
    {
        return view('rrhh::admin.agences.index');
    }

    public function data(Request $request)
    {
        return $this->agences->getDatatableData();
    }

    public function create(Request $request)
    {
        return view('rrhh::admin.agences.form');
    }

    public function store(AgenceRequest $request)
    {
        try {
            $agence = $this->dispatchNow(CreateAgence::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('admin.agences.show', $agence);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.agences.create')->withInput($request->toArray());
    }

    public function show(Agence $agence)
    {
        return view('rrhh::admin.agences.form', [
            'agence' => $agence,
        ]);
    }

    public function update(Agence $agence, AgenceRequest $request)
    {
        try {
            $this->dispatchNow(UpdateAgence::fromRequest($agence, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.agences.show', $agence);
    }

    public function delete(Agence $agence)
    {
        try {
            $this->dispatchNow(new DeleteAgence($agence));
            Session::flash('notify_success', 'Suppression effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.agences.index');
    }

    public function filestore(CreateFileRequest $request)
    {
        return $this->dispatchNow(CreateFile::fromRequest($request));
    }
}
