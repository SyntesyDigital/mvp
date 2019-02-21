<?php

namespace Modules\Extranet\Http\Controllers\Admin\Offers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Http\Requests\Admin\Applications\DeleteApplicationRequest;
use Modules\Extranet\Jobs\Applications\DeleteApplication;
use Modules\Extranet\Jobs\Applications\UpdateApplication;
use Modules\Extranet\Entities\Offers\Application;
use Modules\Extranet\Repositories\ApplicationRepository;
use Modules\Extranet\Repositories\UserRepository;
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
        return view('extranet::admin.applications.index');
    }

    public function spontaneous(Request $request)
    {
        return view('extranet::admin.applications.spontaneous');
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
