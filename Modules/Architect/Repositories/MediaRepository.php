<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use DataTables;
use Storage;
use Modules\Architect\Entities\Media;

class MediaRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Media";
    }

    public function getDatatable()
    {
        $medias = Media::leftJoin('users', 'users.id', '=', 'medias.author_id')
            ->select(
                'medias.*',
                'users.firstname',
                'users.lastname'
            );

        return Datatables::of($medias->orderBy('created_at', 'desc'))
            ->filterColumn('author', function ($query, $keyword) {
                $query->whereRaw("CONCAT(users.firstname,' ',users.lastname) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('author', function ($item) {
                return $item->author->full_name;
            })
            ->addColumn('preview', function ($item) {
                switch($item->type) {
                    case "image":
                        return '<img src="' . Storage::url('medias/' . config('images.display') .  '/' . $item->stored_filename) . '?t='.time().'" class="thumbnail" />';
                        break;

                    default:
                        return '';
                        break;
                }

            })
            ->addColumn('action', function ($item) {

                $html = "";

                //$html .= '<a href="'..'" target="_blank" class="btn btn-sm" data-id="'.$item->id.'"><i class="fa fa-pencil"> &nbsp; Editar</a>';

                if($item->type == "image") {
                    $html .= '<a href="#" class="btn btn-link toogle-edit" data-toogle="edit" data-id="'.$item->id.'"><i class="fa fa-pencil"></i> Editar</a> &nbsp;';
                }

                $html .= '<a href="#" class="btn btn-link text-danger" data-toogle="delete" data-ajax="'.route('medias.delete', $item).'" data-confirm-message="Estàs segur ?"><i class="fa fa-trash"></i> Esborrar</a> &nbsp;';

                return $html;
            })
            ->rawColumns(['preview', 'action'])
        ->make(true);
    }
}
