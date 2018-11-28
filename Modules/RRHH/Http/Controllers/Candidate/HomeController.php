<?php

namespace Modules\RRHH\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\RRHH\Repositories\OfferRepository;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('candidate.home', [
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            ]);
    }
}
