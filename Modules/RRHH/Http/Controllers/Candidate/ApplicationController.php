<?php

namespace Modules\RRHH\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\RRHH\Entities\Tools\SiteList;
use Modules\RRHH\Repositories\OfferRepository;
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
        return view('candidate.application', [
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
               ->addColumn('actions', function ($item) {
                   return '<a href="'.route('offer.show', [
                                    'job_1' => str_slug(SiteList::getListValue($item->offer->job_1, 'jobs1'), '-'),
                                    // 'job_2' => str_slug(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_2, 'jobs2'), '-'),
                                    'id' => $item->offer->id,
                                ]).'" class="btn btn-sm btn-success pull-right">Voir Offre</a>';
               })
            ->make(true);
    }
}
