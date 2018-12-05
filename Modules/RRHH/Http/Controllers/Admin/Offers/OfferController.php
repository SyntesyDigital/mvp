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
use Modules\RRHH\Repositories\OfferRepository;
use Modules\RRHH\Repositories\UserRepository;
use Config;
use Illuminate\Http\Request;
use Session;

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
}
