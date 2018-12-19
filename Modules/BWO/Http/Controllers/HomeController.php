<?php

namespace Modules\BWO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\RRHH\Entities\Offers\Offer;
use Illuminate\Notifications\Messages\MailMessage;
use League\OAuth2\Client\Provider\LinkedIn;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct() {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $provider = new LinkedIn([
        //     'clientId' => env('LINKEDIN_KEY'),
        //     'clientSecret' => env('LINKEDIN_SECRET'),
        //     'redirectUri' => env('LINKEDIN_REDIRECT_URI'),
        // ]);
        //
        // return redirect($provider->getAuthorizationUrl());

        return view('bwo::home', [
          'offers' => Offer::where('status', Offer::STATUS_ACTIVE)->orderBy('created_at', 'desc')->limit(6)->get()
        ]);
    }
}
