<?php

namespace Modules\RRHH\Jobs\Offers;

use Modules\RRHH\Http\Requests\Admin\Offers\UpdateOfferRequest;
use Modules\RRHH\Entities\Offers\Offer;
use Modules\RRHH\Entities\Offers\OfferField;
use Carbon\Carbon;
use Config;
use Modules\RRHH\Traits\FormFields;

class UpdateOffer
{
    use FormFields;

    public function __construct(Offer $offer, array $attributes = [])
    {
        $this->offer = $offer;
        $this->alertsCandidates = isset($attributes['alerts_candidates']) ? boolval($attributes['alerts_candidates']) : false;
        $this->fields = $this->getFields();
        $this->attributes = array_only($attributes, $this->fields);
    }

    public static function fromRequest(Offer $offer, UpdateOfferRequest $request)
    {
        return new self($offer, $request->all());
    }

    public function getNewsTags()
    {
        $tags = [];
        if ((isset($this->attributes['tags'])) && sizeof($this->attributes['tags'])) {
            foreach ($this->attributes['tags'] as $tagId) {
                if (! $this->offer->tags->pluck('id')->contains($tagId)) {
                    $tags[] = $tagId;
                }
            }
        }

        return $tags;
    }

    public function sendCustomerAlerts()
    {
        if (Offer::STATUS_ACTIVE == $this->offer->status && Carbon::createFromFormat('d/m/Y', $this->attributes['start_at'])->lte(Carbon::today())) {
            $candidates = $this->offer->getCandidatesToAlerts();

            foreach ($candidates as $candidate) {
                dispatch(new CreateAlertCandidate($candidate, $this->offer));
            }
        }
    }

    public function handle()
    {
        //
        // TODO : Check if new tags and send alerts to candidates ONLY if offer is already published and date >= today()
        //
        if (!$this->offer->update([
            'status' => $this->attributes['status'],
            'recipient_id' => $this->attributes['recipient_id'],
            'customer_id' => isset($this->attributes['customer_id']) ? $this->attributes['customer_id'] : null,
            //'customer_contact_id' => isset($this->attributes['customer_contact_id']) ? $this->attributes['customer_contact_id'] : null,
        ])) {
            return false;
        }

        // Set tags
        $tags = isset($this->attributes['tags']) ? $this->attributes['tags'] : [];

        $this->offer->tags()->sync($tags);

        // Set fields
        $this->offer->fields()->delete();

        foreach ($this->fields as $name) {
            $value = isset($this->attributes[$name]) ? $this->attributes[$name] : null;

            if($this->getFieldType($name, config('offers.form')) == "date") {
                $value = Carbon::createFromFormat('d/m/Y', $value)->timestamp;
            }

            if ($value && ! array_key_exists($name, $this->offer->getFillable())) {
                if (is_array($value)) {
                    foreach ($value as $k => $v) {
                        OfferField::create([
                            'offer_id' => $this->offer->id,
                            'name' => $name,
                            'value' => trim($v),
                        ]);
                    }
                } else {
                    OfferField::create([
                        'offer_id' => $this->offer->id,
                        'name' => $name,
                        'value' => trim($value),
                    ]);
                }
            }
        }

        $this->sendCustomerAlerts();

        return $this->offer;
    }
}
