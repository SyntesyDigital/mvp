<?php

namespace Modules\BWO\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\RRHH\Entities\Offers\Offer;
use Modules\RRHH\Entities\Tag;
use Modules\RRHH\Entities\Tools\SiteList;
use Modules\RRHH\Repositories\OfferRepository;
use Illuminate\Http\Request;

class OfferController extends Controller
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
    public function index($job_1, Offer $offer, Request $request)
    {

        $url = route('offer.show', [
            'job_1' => str_slug(SiteList::getListValue($offer->job_1, 'jobs1'), '-'),
            'id' => $offer->id,
        ]);


        if (url()->current() != $url) {
            abort(404);
        }

        return view('bwo::offer', [
            'offer' => $offer,
            'coords' => $offer->setGeo(),
            'related_offers' => $this->offers->getRandomOffers($offer->tags()->get()->pluck('id'), 3, $offer->id),
            //'related_offers' => null !== $offer->recipient->agences()->first() ? $this->offers->getRandomOffersByAgence($offer->recipient->agences()->first()->id, 3, $offer->id, $offer->tags()->get()->pluck('id')) : null,

            //'allTags' => Tag::orderBy('name')->get(),
            'search_params' => $request->session()->has('search_params') ? $request->session()->get('search_params') : false,
        ]);
    }
}
