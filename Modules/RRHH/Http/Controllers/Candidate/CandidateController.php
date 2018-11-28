<?php

namespace Modules\RRHH\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Candidate\CandidateEditRequest;
use Modules\RRHH\Jobs\Candidate\UpdateCandidate;
use Modules\RRHH\Repositories\OfferRepository;
use Auth;
use Illuminate\Http\Request;
use Session;

class CandidateController extends Controller
{
    public function __construct(
        OfferRepository $offers
    ) {
        $this->offers = $offers;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('candidate.profile', [
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            'active_hex' => 'profile',
        ]);
    }

    public function store(CandidateEditRequest $request)
    {
        try {
            $this->dispatchNow(new UpdateCandidate(Auth::user(), $request->all()));
            Session::flash('notify_success', 'Votre profil vient d\'être mis à jour.');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('candidate.profile');
    }
}
