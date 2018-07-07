<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Architect\Traits\HasFields;

class Content extends Model
{
    use HasFields;

    const STATUS_PUBLISHED = 'PUBLISHED';
    const STATUS_DRAFT = 'DRAFT';

    protected $fieldModel = 'Modules\Architect\Entities\ContentField';

    protected $appends = ['title'];

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
        'author_id',
        'parent_id',
        'is_page',
        'published_at'
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
        'deleted_at',
        'published_at'
    ];

    public function typology()
    {
        return $this->hasOne('\Modules\Architect\Entities\Typology', "id", "typology_id");
    }

    public function tags()
    {
        return $this->belongsToMany('\Modules\Architect\Entities\Tag', 'contents_tags');
    }

    public function languages()
    {
        return $this->belongsToMany('\Modules\Architect\Entities\Language', 'contents_languages');
    }

    public function categories()
    {
        return $this->belongsToMany('\Modules\Architect\Entities\Category', 'contents_categories',  'content_id', 'category_id');
    }

    public function author()
    {
        return $this->hasOne('App\Models\User', "id", "author_id");
    }

    public function page()
    {
        return $this->belongsTo('\Modules\Architect\Entities\Page', 'id', 'content_id');
    }

    public function getStringStatus()
    {

        $status = [
            1 => trans('architect::contents.published'),
            0 => trans('architect::contents.draft'),
            self::STATUS_PUBLISHED => trans('architect::contents.published'), //'Publicat',//__('contents.status.published'),
            self::STATUS_DRAFT => trans('architect::contents.draft') //'Esborrany' //__('contents.status.draft')
        ];

        return isset($status[$this->status]) ? $status[$this->status] : null;
    }


    public function getTitleAttribute()
    {

        if($this->page) {
            return $this->getFieldValue('title');
        }

        if(!$this->fields || !$this->typology) {
            return null;
        }

        $index = $this->typology->getIndexField();

        if(!$index) {
            return null;
        }

        foreach($this->fields as $field) {
            if($field->name == $index) {
                return $this->getFieldValue($index);
            }
        }

        return null;
    }

}
