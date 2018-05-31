<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Architect\Traits\HasFields;

class Content extends Model
{
    use HasFields;

    const STATUS_PUBLISHED = 'PUBLISHED';
    const STATUS_DRAFT = 'DRAFT';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'typology_id',
        'user_id',
        'author_id'
    ];

    /**
     * The attributes that are hidden from serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function typology()
    {
        return $this->hasOne('\Modules\Architect\Entities\Typology', "id", "typology_id");
    }

    public function fields()
    {
        return $this->hasMany('\Modules\Architect\Entities\ContentField');
    }

    public function author()
    {
        return $this->hasOne('App\Models\User', "id", "author_id");
    }

    public function getStringStatus()
    {

        $status = [
            1 => 'Publicat',
            0 => 'Esborrany',
            self::STATUS_PUBLISHED => 'Publicat',//__('contents.status.published'),
            self::STATUS_DRAFT => 'Esborrany' //__('contents.status.draft')
        ];

        return isset($status[$this->status]) ? $status[$this->status] : null;
    }

}
