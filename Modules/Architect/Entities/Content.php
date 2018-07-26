<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Architect\Traits\HasFields;
use Kalnoy\Nestedset\NodeTrait;

use Modules\Architect\Entities\Language;

class Content extends Model
{
    use HasFields, NodeTrait;

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
        'published_at',
        'settings'
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

    public function parent()
    {
    	return $this->hasOne('\Modules\Architect\Entities\Content', 'id', 'parent_id');
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
        $defaultLanguage = Language::getDefault();
        $defaultLanguageId = isset($defaultLanguage->id) ? $defaultLanguage->id : null;

        if($this->page) {
            return $this->getFieldValue('title', $defaultLanguageId);
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
                return $this->getFieldValue($index, $defaultLanguageId);
            }
        }

        return null;
    }

    public function getFullSlug()
    {
        // FIXME : cache-it with a key that use updated_at, like md5(content_[id]_fullslug_[updated_at])
        // WARNING : If we use cache we need to think what happen when slug's children change.
        $nodes = self::with('fields')->ancestorsOf($this->id);
        $slug = '';

        foreach($nodes as $node) {
            $slug = $slug . '/' . $node->getFieldValue('slug');
        }

        return $slug . '/' . $this->getFieldValue('slug');
    }

    public function getSettings()
    {
        if($this->page && $this->page->settings && $this->page->settings != null) {
          return json_decode($this->page->settings);
        }

        return null;
    }

}
