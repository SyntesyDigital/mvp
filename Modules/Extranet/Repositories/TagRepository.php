<?php

namespace Modules\Extranet\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Modules\Extranet\Entities\Tag;
use Datatables;
use DB;
use Lang;

class TagRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Extranet\\Entities\\Tag";
    }

    public function getDataTableData()
    {
        $tags = Tag::all();

        return Datatables::of($tags)

            ->addColumn('action', function ($tag) {
                return '<a title="'.Lang::get("architect::datatables.edit").'" href="'.route('extranet.admin.tags.show', $tag).'" class="btn btn-link"><i class="fa fa-pencil"></i></a>
                <a title="'.Lang::get("architect::datatables.delete").'" href="#" class="btn btn-link text-danger" data-toogle="delete" data-ajax="' . route('extranet.admin.tags.delete', $tag) . '" data-confirm-message="'.Lang::get('architect::datatables.sure').'"><i class="fa fa-trash"></i> </a>
                ';
            })

        ->make(true);
    }
}
