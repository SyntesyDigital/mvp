<?php

namespace Modules\Extranet\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Repositories\ExtranetModelRepository;

use Config;
use Illuminate\Http\Request;
use Session;

class ExtranetController extends Controller
{
    public function __construct(ExtranetModelRepository $models) {
        $this->models = $models;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('extranet::extranet.index',['models' => $this->models->all()]);
    }

    public function data(Request $request)
    {

    }

    /*
    public function show(Offer $offer, Request $request)
    {
        return view('extranet::admin.offers.form', [
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

        return redirect()->route('extranet.admin.offers.show', $offer);
    }
    */
    public function create(Request $request)
    {
      dd(json_decode($this->models->first()->config));
        //FIXME change with fields from Model json
        //FIXME change form_name -> name, name -> label
        return view('extranet::extranet.form', [
            'modelForm' => Config::get('models.sinister.fields'),
        ]);
    }
    /*

    public function store(CreateOfferRequest $request)
    {
        try {
            $offer = $this->dispatchNow(CreateOffer::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('extranet.admin.offers.show', $offer);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('extranet.admin.offers.create');
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

        return redirect()->route('extranet.admin.offers.index');
    }

    public function recipients(Request $request)
    {
        return response()->json($this->users->getAllByRoles(['recruiter', 'admin'])->mapWithKeys(function ($item) {
            return [
                $item->id => $item->full_name,
            ];
        }));
    }

    */
}
