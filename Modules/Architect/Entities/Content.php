<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Architect\Traits\HasFields;
use Kalnoy\Nestedset\NodeTrait;

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


    public function getFieldByIdentifier($identifier)
    {
        $field = null;
        foreach($this->fields as $f) {
            if($identifier == $f->name) {
                if($field != null) {
                    if(is_array($field)) {
                        $field[] = $f;
                    } else {
                        $field = [$field, $f];
                    }
                } else {
                    $field = $f;
                }
            }
        }

        return $field;
    }


    public function getFieldValues($identifier, $type, $languages)
    {
        $field = $this->getFieldByIdentifier($identifier);

        switch($type) {
            case 'richtext':
            case 'slug':
            case 'text':
                $values = [];
                if(is_array($field)) {
                    return collect($field)->mapWithKeys(function($f) use ($languages) {
                        $iso = null;
                        foreach($languages as $l) {
                            if($f->language_id == $l->id) {
                                $iso = $l->iso;
                            }
                        }

                        return [$iso => $f->value];
                    });
                }
                return $field->value;
            break;

            case 'localization':
                return json_decode($field->value, true);
            break;

            case 'images':
            case 'image':
                $field = !is_array($field) ? [$field] : $field;
                return Media::whereIn('id', collect($field)->pluck('value'))->get();
            break;

            case 'contents':
                $field = !is_array($field) ? [$field] : $field;
                return Content::whereIn('id', collect($field)->pluck('value'))->get();
            break;

            case 'url':
            case 'link':
                $values = null;
                $childs = $this->getFieldChilds($field);


                if($childs != null){
                  foreach($childs as $k => $v) {

                      if($v->language_id) {
                          $iso = null;
                          foreach($languages as $l) {
                              if($v->language_id == $l->id) {
                                  $iso = $l->iso;
                              }
                          }

                          $values[ explode('.', $v->name)[1] ][$iso] = $v->value;
                      } else {
                          if(explode('.', $v->name)[1] == 'content') {
                              $values[ explode('.', $v->name)[1] ] = Content::find($v->value);
                          }
                      }
                  }
                }
                return $values;
            break;
            //
            // case 'video':
            //     $values = null;
            //     $childs = $this->content->getFieldChilds($contentField);
            //
            //     if($childs != null){
            //       foreach($childs as $k => $v) {
            //           if($v->language_id) {
            //               $iso = $this->getLanguageIsoFromId($v->language_id);
            //               $values[ explode('.', $v->name)[1] ][$iso] = $v->value;
            //           }
            //       }
            //     }
            //
            //     $typologyField->value = $values;
            // break;
            //
            // default:
            //     $values = isset($typologyField->value) ? $typologyField->value : $contentField->value;
            //
            //     if($values && !is_array($values)) {
            //         $values = [$values];
            //         $values[] = $contentField->value;
            //     }
            //
            //     $typologyField->value = $contentField->value;
            // break;
        }
    }

}
