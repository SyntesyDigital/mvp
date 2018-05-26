<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Media extends Model
{

    protected $casts = [
        'metadata' => 'array'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'type',
         'mime_type',
         'stored_filename',
         'uploaded_filename',
         'metadata',
         'author_id'
     ];

    /**
     * The attributes that are hidden from serialization.
     *
     * @var array
     */
    protected $hidden = [];

    public function author()
    {
        return $this->hasOne('App\Models\User', 'id', 'author_id');
    }

    public function getMetaJSON()
    {
        return json_encode($this->metadata);
    }

}
