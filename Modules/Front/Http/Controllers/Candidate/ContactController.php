<?php

namespace Modules\Front\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\Extranet\Http\Requests\Front\ContactRequest;
use Modules\Extranet\Jobs\Contact\SendContact;
use Modules\Extranet\Repositories\OfferRepository;
use Auth;
use Illuminate\Http\Request;
use Session;

class ContactController extends Controller
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
        return view('front::candidate.contact', [
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            'active_hex' => 'contact',
        ]);
    }

    public function send(ContactRequest $request)
    {
        if ($sent = $this->dispatch(new SendContact($request->all()))) {
            return redirect()->route('candidate.contact')->with('success','Le message a été envoyés correctement');
        } else {
            return redirect()->route('candidate.contact')->with('error',"Une erreur s'est produite lors de l'envoi de le message")->withInput();
        }
    }
}
