<?php

namespace Modules\RRHH\Http\Controllers\Admin\Offers;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\Offers\CreateOfferRequest;
use Modules\RRHH\Http\Requests\Admin\Offers\DeleteOfferRequest;
use Modules\RRHH\Http\Requests\Admin\Offers\UpdateOfferRequest;
use Modules\RRHH\Jobs\Offers\CreateOffer;
use Modules\RRHH\Jobs\Offers\DeleteOffer;
use Modules\RRHH\Jobs\Offers\UpdateOffer;
use Modules\RRHH\Entities\Offers\Offer;
use Modules\RRHH\Notifications\PublishOnFacebookPage;
use Modules\RRHH\Repositories\OfferRepository;
use Modules\RRHH\Repositories\UserRepository;
use Config;
use Illuminate\Http\Request;
use Session;
use Facebook\Facebook;

class OfferController extends Controller
{
    public function __construct(
        OfferRepository $offers,
        UserRepository $users
    ) {
        $this->offers = $offers;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        return view('rrhh::admin.offers.index');
    }

    public function data(Request $request)
    {
        return $this->offers->getDataTableData();
    }

    public function show(Offer $offer, Request $request)
    {
        return view('rrhh::admin.offers.form', [
            'form' => Config::get('offers.form'),
            'offer' => $offer,
        ]);
    }

    public function update(Offer $offer, UpdateOfferRequest $request)
    {
        try {
            $offer = $this->dispatchNow(UpdateOffer::fromRequest($offer, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.offers.show', $offer);
    }

    public function create(Request $request)
    {
        return view('rrhh::admin.offers.form', [
            'form' => Config::get('offers.form'),
        ]);
    }

    public function store(CreateOfferRequest $request)
    {
        try {
            $offer = $this->dispatchNow(CreateOffer::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('rrhh.admin.offers.show', $offer);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.offers.create');
    }

    public function delete(Offer $offer, DeleteOfferRequest $request)
    {
        $success = false;
        $message = null;

        try {
            if ($this->dispatchNow(DeleteOffer::fromRequest($offer, $request))) {
                $message = 'Offre supprimée avec succès';
                $success = true;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        }

        Session::flash($success ? 'notify_success' : 'notify_error', $message);

        return redirect()->route('rrhh.admin.offers.index');
    }

    public function recipients(Request $request)
    {
        return response()->json($this->users->getAllByRoles(['recruiter', 'admin'])->mapWithKeys(function ($item) {
            return [
                $item->id => $item->full_name,
            ];
        }));
    }

    // FIXME : Put this on a job :)
    public function publishFacebook(Offer $offer, Request $request)
    {
        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v3.2'
        ]);

        $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken(env('FACEBOOK_ACCESS_TOKEN'));
        $fb->setDefaultAccessToken($longLivedToken);

        $response = $fb->sendRequest('GET', env('FACEBOOK_PAGE_ID'), ['fields' => 'access_token'])
            ->getDecodedBody();

        $foreverPageAccessToken = $response['access_token'];

        $url = route('offer.show', [
            'job_1' => str_slug(\Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_1, 'jobs1'), '-'),
            'id' => $offer->id
        ]);

        $fb->setDefaultAccessToken($foreverPageAccessToken);
        $result = $fb->sendRequest('POST', env('FACEBOOK_PAGE_ID') . "/feed", [
            'message' => $offer->title,
            'link' => $url,
        ]);

        $response = json_decode($result->getBody());

        if(isset($response->id)) {
            Session::flash('notify_success', 'L\'offre a été publié sur la page facebook');
        } else {
            Session::flash('notify_error', 'Une erreur est survenue');
        }

        return redirect()->route('rrhh.admin.offers.show', $offer);
    }
}
