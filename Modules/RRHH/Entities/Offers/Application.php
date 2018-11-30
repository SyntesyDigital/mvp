<?php

namespace Modules\RRHH\Entities\Offers;

use Modules\RRHH\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use DatePresenter;

    const TYPE_SPONTANEOUS = 'SPONTANEOUS';
    const TYPE_OFFER = 'OFFER';

    const STATUS_PENDING = 'PENDING';
    const STATUS_TO_CONTACT = 'TO_CONTACT';
    const STATUS_REFUSED = 'REFUSED';
    const STATUS_ACCEPTED = 'ACCEPTED';
    const STATUS_INTERVIEW = 'INTERVIEW';
    const STATUS_ARCHIVED = 'ARCHIVED';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id',
        'candidate_id',
        'done_at',
        'type',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'done_at',
    ];

    public function candidate()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Offers\Candidate');
    }

    public function offer()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Offers\Offer');
    }

    public function getDoneAtAttribute($date)
    {
        return $this->getDateFormated($date);
    }

    public static function getTypes()
    {
        return [
            self::TYPE_SPONTANEOUS => 'Candidature spontanées',
            self::TYPE_OFFER => 'Candidature à une offre',
        ];
    }

    public static function getStatus()
    {
        return [
            self::STATUS_PENDING => 'Nouvelle',
            self::STATUS_TO_CONTACT => 'A contacter',
            self::STATUS_REFUSED => 'Refusée',
            self::STATUS_ACCEPTED => 'Pré-sélectionné',
            self::STATUS_ARCHIVED => 'Archivée',
        ];
    }

    public function getStatusString()
    {
        return isset(self::getStatus()[$this->status])
            ? self::getStatus()[$this->status]
            : null;
    }

    public function getTypeString()
    {
        return isset(self::getTypes()[$this->type])
            ? self::getTypes()[$this->type]
            : null;
    }
}
