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

    public function getDatatable()
    {
        return Datatables::of($this->model->with('fields'))
            ->addColumn('title', function ($item) {
                return $item->getField('title');
            })
            ->addColumn('updated', function ($item) {
                return $item->updated_at->format('d, M, Y');
            })
            ->addColumn('typology', function ($item) {
                return $item->typology->name;
            })
            ->addColumn('author', function ($item) {
                return $item->author->full_name;
            })
            ->addColumn('action', function ($item) {
                return '';
            })
            ->make(true);
    }
}
