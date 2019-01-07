<?php

namespace Modules\RRHH\Entities\Offers;

use App\Models\User;
use Modules\RRHH\Presenters\DatePresenter;
use Auth;
use Cache;
use Geocoder\Geocoder;
use Illuminate\Database\Eloquent\Model;

use Modules\RRHH\Traits\FormFieldsEntity;

use Illuminate\Database\Eloquent\Builder;
use DB;

class Offer extends Model
{
    use DatePresenter;
    use FormFieldsEntity;

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_UNACTIVE = 'UNACTIVE';

    public $fieldModel = 'Modules\RRHH\Entities\Offers\OfferField';
    public $fieldKey = 'offer_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'recipient_id',
        'customer_id',
        'customer_contact_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function recipient()
    {
        return $this->hasOne('App\Models\User', 'id', 'recipient_id');
    }

    public function agence()
    {
        return $this->hasOne('Modules\RRHH\Entities\Agence', 'id', 'agence_id');
    }


    public function tags()
    {
        return $this->belongsToMany('Modules\RRHH\Entities\Tag', 'offers_tags');
    }

    public function applications()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\Application');
    }

    public function alerts()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\AlertCandidate');
    }

    public function customer()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Customer');
    }

    public function customer_contact()
    {
        return $this->belongsTo('Modules\RRHH\Entities\CustomerContact', 'customer_contact_id');
    }

    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_UNACTIVE => 'Inactive',
        ];
    }

    public function getStringStatus()
    {
        return isset($this->getStatus()[$this->status]) ? $this->getStatus()[$this->status] : null;
    }

    public function getCandidatesToAlerts()
    {
        $offer = $this;

        return Candidate::whereHas('user', function ($query) {
            $query->where('status', User::STATUS_ACTIVE);
        })
        ->whereHas('tags', function ($query) use ($offer) {
            $query->whereIn('tag_id', $offer->tags->toArray());
        })
        ->whereDoesntHave('alerts', function ($query) use ($offer) {
            $query
                ->where('offer_id', $offer->id)
                ->where('status', AlertCandidate::STATUS_ERROR);
        })->get();
    }

    public function hasAlreadyCandidate()
    {
        if (Auth::user()->candidate) {
            if ($this->applications()->where('candidate_id', Auth::user()->candidate->id)->first()) {
                return true;
            }
        }

        return false;
    }

    public function setGeo()
    {
        if (null != $this->latitude && null != $this->longitude) {
            return [
                'lat' => $this->latitude,
                'lng' => $this->longitude,
            ];
        } else {
            $address = $this->address.', '.$this->place;
            $data = Cache::has(md5($address)) ? Cache::get(md5($address)) : false;

            if (! $data) {
                $data = app('geocoder')->geocode($address)->get();
                Cache::add(md5($address), $data, 60 * 24);
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


    public function scopeOrderByField(Builder $query, $column, $mode, $iso = null)
    {
        if(in_array($column, $this->fillable) || $column == "id") {
            return $query->orderBy($column, $mode);
        }

        $columnName = $column . '_order';

        $sql = DB::raw(sprintf('(
            SELECT
                offers_fields.value
            FROM
                offers_fields
            WHERE
                offers_fields.offer_id = offers.id
            AND
                offers_fields.name = "%s"
            LIMIT 1
        ) AS %s', $column, $columnName));

        return $query
            ->select('*', $sql)
            ->orderBy($columnName, $mode);
    }
}
