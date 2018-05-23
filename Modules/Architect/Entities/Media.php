<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Media extends Model
{

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
     ];

    /**
     * The attributes that are hidden from serialization.
     *
     * @var array
     */
    protected $hidden = [];

    // public function updateFile($request)
    // {
    //     if ($request->hasFile('media')) {
    //         $file = $request->file('media');
    //         $filename = uniqid(rand(), false).'.'.$file->getClientOriginalExtension();
    //         $mime = $request->file('media')->getMimeType();
    //         $type = $request->input('type');
    //
    //         if (! $type) {
    //             $type = explode('/', $mime)[0];
    //         }
    //
    //         if (Storage::put(env('UPLOAD_DIR').$filename, file_get_contents($request->file('media')->getRealPath()))) {
    //             $path = env('UPLOAD_DIR').$this->file;
    //
    //             Storage::has($path) ? Storage::delete($path) : null;
    //
    //             $this->stored_filename = $filename;
    //             $this->uploaded_filename = $request->file('media')->getClientOriginalName();
    //             $this->mime_type = $mime;
    //             $this->type = $type;
    //
    //             if ($this->save()) {
    //                 return true;
    //             }
    //         }
    //     }
    //
    //     return false;
    // }
    //
    // public static function saveFile($request)
    // {
    //     if ($request->hasFile('media')) {
    //         $file = $request->file('media');
    //         $filename = uniqid(rand(), false).'.'.$file->getClientOriginalExtension();
    //         $mime = $request->file('media')->getMimeType();
    //         $type = $request->input('type');
    //
    //         if (! $type) {
    //             $type = explode('/', $mime)[0];
    //         }
    //
    //         if ($file->move(public_path().'/'.env('UPLOAD_DIR'), $filename)) {
    //             return self::create([
    //                  'file' => $filename,
    //                  'filename' => $request->file('media')->getClientOriginalName(),
    //                  'mime_type' => $mime,
    //                  'type' => $type,
    //                  'title' => $request->input('title'),
    //              ]);
    //         }
    //     }
    //
    //     return false;
    // }
    //
    // public function delete()
    // {
    //     $path = 'public/medias/'.$this->stored_filename;
    //
    //     if (Storage::has($path)) {
    //         Storage::delete($path);
    //     }
    //
    //     return parent::delete();
    // }
    //

    public function getMetaJSON()
    {
        return json_encode($this->metadata);
    }

}
