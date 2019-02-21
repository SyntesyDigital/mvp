<?php

namespace Modules\Extranet\Http\Controllers\Admin\Offers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Http\Requests\Admin\Offers\UpdateOfferApplicationRequest;
use Modules\Extranet\Jobs\Offers\MoveOfferApplication;
use Modules\Extranet\Jobs\Offers\UpdateOfferApplication;
use Modules\Extranet\Entities\Offers\Application;
use Modules\Extranet\Entities\Offers\Offer;
use Modules\Extranet\Repositories\OfferRepository;
use Modules\Extranet\Repositories\UserRepository;
use Illuminate\Http\Request;

class OfferApplicationController extends Controller
{
    public function __construct(
        OfferRepository $offers,
        UserRepository $users
    ) {
        $this->offers = $offers;
        $this->users = $users;
    }

    public function show(Offer $offer, Request $request)
    {
        return view('extranet::admin.offers.applications.form', [
            'offer' => $offer,
            'other_offers' => Offer::where('id', '!=', $offer->id)->where('status', Offer::STATUS_ACTIVE)->get(),
        ]);
    }

    public function update(Application $application, UpdateOfferApplicationRequest $request)
    {
        if ($this->dispatchNow(UpdateOfferApplication::fromRequest($application, $request))) {
            return response()->json([
                'success' => true,
            ], 200);
        }

        return response()->json([
            'success' => false,
        ], 400);
    }

    public function move(Application $application, Request $request)
    {
        return $this->dispatchNow(new MoveOfferApplication($application, $request->get('offer')));
    }
}
