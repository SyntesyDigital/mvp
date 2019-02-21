<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Extranet\Entities\Offers\Offer;
use Illuminate\Notifications\Messages\MailMessage;
use League\OAuth2\Client\Provider\LinkedIn;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('front::home', [
          'offers' => Offer::where('status', Offer::STATUS_ACTIVE)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get()
        ]);
    }
}
