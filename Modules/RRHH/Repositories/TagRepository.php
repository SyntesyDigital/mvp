<?php

namespace Modules\RRHH\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Modules\RRHH\Entities\Tag;
use Datatables;
use DB;

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
                return '<a href="'.route('rrhh.admin.tags.show', $tag).'" class="btn btn-sm btn-success pull-right">Modifier</a>';
            })

        ->make(true);
    }
}
