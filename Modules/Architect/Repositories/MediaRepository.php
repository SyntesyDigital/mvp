<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use DataTables;
use Storage;

class MediaRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Media";
    }

    public function getDatatable()
    {
        return Datatables::of($this->model->orderBy('created_at', 'desc'))
            ->addColumn('preview', function ($item) {
                switch($item->type) {
                    case "image":
                        return '<img src="' . Storage::url('medias/' . $item->stored_filename) . '" class="thumbnail" />';
                        break;

                    default:
                        return '';
                        break;
                }

            })
            ->addColumn('action', function ($item) {
                return '
                    <a href="#" class="btn btn-sm btn-danger" data-toogle="delete" data-ajax="'.route('medias.delete', $item).'" data-confirm-message="Are you sûre ?">Delete</a>
                    <a href="#" class="btn btn-sm btn-success toogle-edit" data-toogle="edit" data-id="'.$item->id.'">Edit</a>
                ';
            })
            ->rawColumns(['preview', 'action'])
        ->make(true);
    }
}
