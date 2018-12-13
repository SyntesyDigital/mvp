<?php

namespace Modules\RRHH\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Candidate\SpontaniousRequest;
use Modules\RRHH\Jobs\Candidate\CreateSpontaniousCandidature;
use Auth;
use Illuminate\Http\Request;
use Session;

class SpontaniousController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->hasRole(['admin', 'recruiter'])) {
            return redirect()->route('admin');
        }

        return view('front.spontanious.form');
    }

    public function success(Request $request)
    {
        return view('front.spontanious.success');
    }

    public function store(SpontaniousRequest $request)
    {
        try {
            if ($this->dispatchNow(CreateSpontaniousCandidature::fromRequest($request))) {
                return redirect()->route('spontanious.success');
            }
            Session::flash('notify_error', 'Une erreur est survenue lors de l\'enregistrement de votre candidature.');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('spontanious.form');
    }
}
