<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use DataTables;
use Modules\Architect\Entities\PageLayout;

class PageLayoutRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\PageLayout";
    }

    public function getDatatable($options = [])
    {
        return Datatables::of(PageLayout::all())
            ->addColumn('action', function ($item) {
                return '
                <a href="#" class="btn btn-link text-danger" data-toogle="delete" data-ajax="' . route('pagelayouts.delete', $item) . '" data-confirm-message="Estàs segur ?"><i class="fa fa-trash"></i> Esborrar</a> &nbsp;
                ';
            })
            ->make(true);
    }

    public function getModalDatatable($options = [])
    {
        return Datatables::of(PageLayout::all())
            ->addColumn('action', function ($item) {
                return '
                <a href="#" data-id="'.$item->id.'" id="item-'.$item->id.'" class="btn btn-link add-item" ><i class="fa fa-plus"></i> Afegir &nbsp;
                ';
            })
            ->make(true);
    }

}
