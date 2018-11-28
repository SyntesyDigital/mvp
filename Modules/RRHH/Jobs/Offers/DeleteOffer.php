<?php

namespace Modules\RRHH\Jobs\Offers;

use Modules\RRHH\Http\Requests\Admin\Offers\DeleteOfferRequest;
use Modules\RRHH\Entities\Offers\Offer;

class DeleteOffer
{
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public static function fromRequest(Offer $offer, DeleteOfferRequest $request)
    {
        return new self($offer, $request->all());
    }

    public function handle()
    {
        return $this->offer->delete() > 0 ? true : false;
    }
}
