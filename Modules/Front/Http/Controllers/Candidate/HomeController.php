<?php

namespace Modules\Front\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\Extranet\Repositories\OfferRepository;
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
        return view('front::candidate.home', [
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            ]);
    }
}
