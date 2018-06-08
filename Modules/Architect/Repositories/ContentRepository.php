<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use DataTables;
use Storage;
use Modules\Architect\Entities\Content;

class ContentRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Content";
    }

    public function getDatatable($where = null)
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
                <a href="' . route('contents.show', $item) . '" class="btn btn-link" data-toogle="edit" data-id="'.$item->id.'"><i class="fa fa-pencil"></i> Editar</a> &nbsp;
                <a href="#" class="btn btn-link text-danger" data-toogle="delete" data-ajax="#" data-confirm-message="Estàs segur ?"><i class="fa fa-trash"></i> Esborrar</a> &nbsp;
                ';
            })
            ->make(true);
    }
}
