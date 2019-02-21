<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Repositories\OfferRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        OfferRepository $offers
    ) {
        $this->offers = $offers;
        $this->itemsPerPage = 10;
    }

    public function index(Request $request)
    {
        $offers = $this->offers->getSearchOffers(
            $request->get('search'),
            $request->get('contract'),
            $request->get('job'),
            $request->get('agence'),
            $this->itemsPerPage,
            $request->get('page') ? $request->get('page') : 0,
            $request->get('order')
        );
        //delete page parameter for url contruction for pagination
        $params_array = $request->all();
        if(isset($params_array['page'])){
          unset($params_array['page']);
        }

        return view('front::results', [
            'offers' => $offers,
            'num_offers' => $this->offers->getSearchOffers($request->get('search'), $request->get('contract'), $request->get('job'), $request->get('agence'))->count(),
            'offers_paginate' => $offers,
            'selected_agence' => $request->get('agence') ? $request->get('agence') : [],
            'selected_job' => $request->get('job') ? $request->get('job') : [],
            'selected_contract' => $request->get('contract') ? $request->get('contract') : [],
            'search' => $request->get('search'),
            'items_per_page' => $this->itemsPerPage,
            'page' => $request->get('page') ? $request->get('page') : 0,
            'pagination_url' => route('search',$params_array).'?page='
        ]);
    }
}
