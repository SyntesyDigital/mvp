<?php

namespace Modules\RRHH\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Modules\RRHH\Entities\Tag;
use Datatables;
use DB;
use Lang;

class TagRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\RRHH\\Entities\\Tag";
    }

    public function getDataTableData()
    {
        $tags = Tag::all();

        return Datatables::of($tags)

            ->addColumn('action', function ($tag) {
                return '<a href="'.route('rrhh.admin.tags.show', $tag).'" class="btn btn-sm btn-success pull-right">Modifier</a>
                <a href="#" class="btn btn-sm text-danger trigger-delete" data-toogle="delete" data-ajax="' . route('rrhh.admin.tags.delete', $tag) . '" data-confirm-message="'.Lang::get('architect::datatables.sure').'"><i class="fa fa-trash"></i> Suprimer</a>
                ';
            })

        ->make(true);
    }
}
