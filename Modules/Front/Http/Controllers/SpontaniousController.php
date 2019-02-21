<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Http\Requests\Candidate\SpontaniousRequest;
use Modules\Extranet\Jobs\Candidate\CreateSpontaniousCandidature;
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
            return redirect()->route('dashboard');
        }

        return view('front::spontanious.form');
    }

    public function success(Request $request)
    {
        return view('front::spontanious.success');
    }

    public function store(SpontaniousRequest $request)
    {
        try {
            if ($this->dispatchNow(CreateSpontaniousCandidature::fromRequest($request))) {
                Session::flash('notify_success', 'Merci de nous avoir adressé votre candidature.');
            }
            Session::flash('notify_error', 'Une erreur est survenue lors de l\'enregistrement de votre candidature.');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('spontanious.form');
    }
}
