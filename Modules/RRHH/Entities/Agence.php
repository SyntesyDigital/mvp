<?php

namespace Modules\RRHH\Entities;

use Cache;
use Geocoder\Geocoder;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    protected $imagesUpload = ['image'];

    protected $table = 'agences';

    protected $fillable = [
        'meta_title',
        'slug',
        'meta_description',
        'email',
        'phone',
        'fax',
        'address',
        'postal_code',
        'image',
        'name',
        'content',
        'latitude',
        'longitude',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'agence_user', 'agence_id', 'user_id');
    }

    /**
     *   Get content by slug.
     */
    public static function getBySlug($slug, $languageId = null)
    {
        return self::where('slug', $slug);
    }

    public function offers()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\Offer', 'agence_id', 'id');
    }

    public function setGeo()
    {
        if (null != $this->latitude && null != $this->longitude) {
            return [
                'lat' => $this->latitude,
                'lng' => $this->longitude,
            ];
        } else {
            $address = $this->address.', '.$this->postal_code;
            $data = Cache::has(md5($address)) ? Cache::get(md5($address)) : false;

            if (! $data) {
                $data = app('geocoder')->geocode($address)->get();
                Cache::forever(md5($address), $data);
            }

            if (isset($data[0]) && null !== $data[0]) {
                return [
                    'lat' => $data[0]->getCoordinates()->getLatitude(),
                    'lng' => $data[0]->getCoordinates()->getLongitude(),
                ];
            }

            return null;
        }
    }
}
