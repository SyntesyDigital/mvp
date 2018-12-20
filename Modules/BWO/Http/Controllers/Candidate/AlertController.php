<?php

namespace Modules\BWO\Http\Controllers\Candidate;

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
        return view('bwo::candidate.alert', [
            'user_tags' => Auth::user()->candidate->tags()->get()->pluck('id')->all(),
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            'active_hex' => 'alert',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->dispatchNow(new UpdateCandidateTags(Auth::user(), $request->input('tags')));

            return redirect()->route('candidate.alert')->with('success','Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            return redirect()->route('candidate.alert')->with('error',$e->getMessage());
        }

    }
}
