<?php

namespace Modules\Front\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\Extranet\Entities\Tools\SiteList;
use Modules\Extranet\Repositories\OfferRepository;
use Auth;
use Datatables;
use Illuminate\Http\Request;

class ApplicationController extends Controller
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
        return view('front::candidate.application', [
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            'active_hex' => 'application',
        ]);
    }

    public function data(Request $request)
    {
        return Datatables::of(Auth::user()->candidate->applications)
               ->addColumn('title', function ($item) {
                   return $item->offer->title;
               })
               ->addColumn('done_at', function ($item) {
                   return $item->done_at;
               })
               ->addColumn('status', function ($item) {
                   return $item->getStatusString();
               })
               ->addColumn('action', function ($item) {
                   return '<a href="'.route('offer.show', [
                                    'job_1' => str_slug(SiteList::getListValue($item->offer->job_1, 'jobs1'), '-'),
                                    // 'job_2' => str_slug(Modules\Extranet\Entities\Tools\SiteList::getListValue($offer->job_2, 'jobs2'), '-'),
                                    'id' => $item->offer->id,
                                ]).'" class="btn btn-link pull-right"><i class="fa fa-eye"></i> Voir Offre</a>';
               })
            ->make(true);
    }
}
