<?php

namespace Modules\RRHH\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\RRHH\Jobs\Tags\UpdateCandidateTags;
use Modules\RRHH\Repositories\OfferRepository;
use Auth;
use Illuminate\Http\Request;
use Session;

class AlertController extends Controller
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
        return view('candidate.alert', [
            'user_tags' => Auth::user()->candidate->tags()->get()->pluck('id')->all(),
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            'active_hex' => 'alert',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->dispatchNow(new UpdateCandidateTags(Auth::user(), $request->input('tags')));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('candidate.alert');
    }
}
