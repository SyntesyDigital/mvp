<?php

namespace Modules\RRHH\Entities\Offers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    const CIVILITY_MALE = 'M';
    const CIVILITY_FEMALE = 'F';

    const TYPE_NORMAL = 'NORMAL';
    const TYPE_INTERIM = 'INTERIM';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'candidates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'civility',
        'resume_file',
        'recommendation_letter',
        'type',
        'address',
        'location',
        'postal_code',
        'country',
        'birthday',
        'birthplace',
        'message',
        'comment',
        'job_1',
        'job_2',
        'job_3',
        'registration_number',
        'registered_at',

        'contract_type',
        'salary',
        'important_information'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'contract_type' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function applications()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\Application');
    }

    public function alerts()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\AlertCandidate');
    }

    public function tags()
    {
        return $this->belongsToMany('Modules\RRHH\Entities\Tag', 'candidates_tags');
    }

    public static function getTypes()
    {
        return [
            self::TYPE_NORMAL => 'Candidat',
            self::TYPE_INTERIM => 'Intérimaire',
        ];
    }

    public function getTypeString()
    {
        return isset(self::getTypes()[$this->type])
            ? self::getTypes()[$this->type]
            : null;
    }

    public function scopeCountByType($query, $type)
    {
        return Candidate::whereHas('user', function ($query) {
            $query->where('status', User::STATUS_ACTIVE);
        })
            ->where('type', $type)
            ->count();
    }


    public function scopeByTags($query, $tags = null)
    {
        return $tags ? $query->whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('tag_id', $tags);
        }) : $query;
    }
}
