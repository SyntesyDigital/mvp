<?php

namespace Modules\BWO\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\RRHH\Jobs\Offers\CreateOfferApplication;
use Modules\RRHH\Entities\Offers\Offer;
use App\Models\User;
use Auth;
use Exception;

class OfferApplicationController extends Controller
{
    public function create(Offer $offer)
    {
        $user = Auth::user();

        $httpCode = 500;

        // try {
        //     $this->dispatchNow(new CreateOfferApplication($offer, $user));
        //     $httpCode = 200;
        // } catch (Exception $e) {
        //     switch ($e->getCode()) {
        //        case CreateOfferApplication::EXCEPTION_ALREADY_APPLIED:
        //             $httpCode = 304;
        //             break;
        //        default:
        //             break;
        //     }
        // }

        $this->dispatchNow(new CreateOfferApplication($offer, $user));
        $httpCode = 200;

        return response()->json([
            'success' => true,
            'data' => [],
        ], $httpCode);
    }
}
