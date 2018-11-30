<?php

namespace Modules\RRHH\Http\Controllers\Admin\Offers;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\Applications\DeleteApplicationRequest;
use Modules\RRHH\Jobs\Applications\DeleteApplication;
use Modules\RRHH\Jobs\Applications\UpdateApplication;
use Modules\RRHH\Entities\Offers\Application;
use Modules\RRHH\Repositories\ApplicationRepository;
use Modules\RRHH\Repositories\UserRepository;
use Illuminate\Http\Request;
use Session;

class ApplicationController extends Controller
{
    public function __construct(
        ApplicationRepository $applications,
        UserRepository $users
    ) {
        $this->applications = $applications;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        return view('rrhh::admin.applications.index');
    }

    public function spontaneous(Request $request)
    {
        return view('rrhh::admin.applications.spontaneous');
    }

    public function spontaneousData(Request $request)
    {
        return $this->applications->getSpontaneousDatatable();
    }

    public function data(Request $request)
    {
        return $this->applications->getDatatable();
    }

    public function updateStatus(Request $request)
    {
        $success = false;
        $message = null;

        try {
            if ($this->dispatchNow(new UpdateApplication($this->applications->find($request->get('id')), [
                'status' => $request->get('value'),
            ]))) {
                $success = true;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function delete(Application $application, DeleteApplicationRequest $request)
    {
        $success = false;
        $message = null;

        try {
            if ($this->dispatchNow(DeleteApplication::fromRequest($application, $request))) {
                $message = 'Candidature supprimée avec succès';
                $success = true;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        }

        Session::flash($success ? 'notify_success' : 'notify_error', $message);

        return redirect()->route('admin.applications.index');
    }
}
