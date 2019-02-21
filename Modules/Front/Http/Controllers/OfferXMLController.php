<?php

namespace Modules\Extranet\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Extranet\Entities\Offers\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfferXMLController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offers = Offer::where('status', Offer::STATUS_ACTIVE)->get();
        $offers = $offers->sortByDesc(function ($offer, $key) {
            return strtotime(Carbon::createFromFormat('d/m/Y', $offer->start_at));
        });

        return response()->view('front.offersxml', [
          'offers' => $offers,
          ])->header('Content-Type', 'text/xml');
    }
}
