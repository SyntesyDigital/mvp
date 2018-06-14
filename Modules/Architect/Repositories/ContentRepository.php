<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use DataTables;
use Storage;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Field;

class ContentRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Content";
    }

    public function getDatatable($where = null)
    {
        $results = Content::leftJoin('contents_fields', 'contents.id', '=', 'contents_fields.content_id')
            ->leftJoin('users', 'contents.author_id', '=', 'users.id')
            ->select(
                'contents.*',
                'users.firstname',
                'users.lastname'
            )
            ->groupBy('contents.id');

        if($where) {
            $results->where($where);
        }

        $fields = Field::where('settings', 'LIKE', '%"entryTitle":true%')->get();
        $titleFields = [];

        if($fields) {
            foreach($fields as $k => $v) {
                $titleFields[] = $v->identifier;
            }
        }

        return Datatables::of($results)
            ->filterColumn('title', function ($query, $keyword) use ($titleFields) {
                $query->whereRaw("contents_fields.value LIKE ? AND contents_fields.name IN (?)", ["%{$keyword}%", implode(",", $titleFields)]);
            })
            ->addColumn('title', function ($item) {
                return $item->getField($item->typology->getIndexField());
            })
            ->addColumn('updated', function ($item) {
                return $item->updated_at->format('d, M, Y');
            })
            ->addColumn('status', function ($item) {
                return $item->getStringStatus();
            })
            ->addColumn('typology', function ($item) {
                return $item->typology->name;
            })
            ->addColumn('author', function ($item) {
                return $item->author->full_name;
            })
            ->addColumn('action', function ($item) {
                return '
                <a href="' . route('contents.show', $item) . '" class="btn btn-link" data-toogle="edit" data-id="'.$item->id.'"><i class="fa fa-pencil"></i> Editar</a> &nbsp;
                <a href="#" class="btn btn-link text-danger" data-toogle="delete" data-ajax="#" data-confirm-message="Estàs segur ?"><i class="fa fa-trash"></i> Esborrar</a> &nbsp;
                ';
            })
            ->make(true);
    }

    public function getModalDatatable($where = null)
    {
        $results = $this->model->with('fields');

        if($where) {
            $results->where($where);
        }

        return Datatables::of($results)
            ->addColumn('title', function ($item) {
                return $item->getField('title');
            })
            ->addColumn('updated', function ($item) {
                return $item->updated_at->format('d, M, Y');
            })
            ->addColumn('status', function ($item) {
                return $item->getStringStatus();
            })
            ->addColumn('typology', function ($item) {
                return $item->typology->name;
            })
            ->addColumn('author', function ($item) {
                return $item->author->full_name;
            })
            ->addColumn('action', function ($item) {
                return '
                <a href="" id="item-'.$item->id.'" class="btn btn-link add-item" data-type="'.$item->typology->name.'" data-name="'.$item->getField('title').'" data-id="'.$item->id.'"><i class="fa fa-plus"></i> Afegir</a> &nbsp;
                ';
            })
            ->make(true);
    }
}
