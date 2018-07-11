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

    public function getDatatable($options = [])
    {
        $results = Content::leftJoin('contents_fields', 'contents.id', '=', 'contents_fields.content_id')
            ->leftJoin('users', 'contents.author_id', '=', 'users.id')
            ->select(
                'contents.*',
                'users.firstname',
                'users.lastname'
            )
            ->groupBy('contents.id');

        if(isset($options["where"])) {
            foreach($options["where"] as $where) {
                if(sizeof($where) > 2) {
                    $results->where($where[0], $where[1], $where[2]);
                } else {
                    $results->where($where[0], $where[1]);
                }
            }
        }

        if(isset($options["whereHas"])) {
            foreach($options["whereHas"] as $relation => $where) {
                $results->whereHas($relation, function ($query) use($relation, $where) {
                    if(sizeof($where) > 2) {
                        $query->where($where[0], $where[1], $where[2]);
                    } else {
                        $query->where($where[0], $where[1]);
                    }
                });
            }
        }

        $fields = Field::where('settings', 'LIKE', '%"entryTitle":true%')->get();
        $titleFields = ['title'];

        if($fields) {
            foreach($fields as $k => $v) {
                $titleFields[] = $v->identifier;
            }
        }

        return Datatables::of($results)

            ->addColumn('author', function ($item) {
                return isset($item->author) ? $item->author->full_name : null;
            })
            ->filterColumn('author', function ($query, $author_id) {
                $query->whereRaw("contents.author_id = ?", $author_id);
            })

            ->filterColumn('title', function ($query, $keyword) use ($titleFields) {
                $query->whereRaw("contents_fields.value LIKE ? AND contents_fields.name IN (?)", ["%{$keyword}%", implode(",", $titleFields)]);
            })
            ->addColumn('title', function ($item) {
                return isset($item->title) ? $item->title : null;
            })

            ->addColumn('updated', function ($item) {
                return $item->updated_at->format('d, M, Y');
            })
            ->addColumn('status', function ($item) {
                return $item->getStringStatus();
            })
            ->addColumn('typology', function ($item) {
                if($item->page) {
                    return 'Page';
                }
                return isset($item->typology) ? ucfirst(strtolower($item->typology->name)) : null;
            })

            ->addColumn('action', function ($item) {
                return '
                <a href="' . route('contents.show', $item) . '" class="btn btn-link" data-toogle="edit" data-id="'.$item->id.'"><i class="fa fa-pencil"></i> Editar</a> &nbsp;
                <a href="#" class="btn btn-link text-danger" data-toogle="delete" data-ajax="' . route('contents.delete', $item) . '" data-confirm-message="Estàs segur ?"><i class="fa fa-trash"></i> Esborrar</a> &nbsp;
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
                return isset($item->title) ? $item->title : null;
            })
            ->addColumn('updated', function ($item) {
                return $item->updated_at->format('d, M, Y');
            })
            ->addColumn('status', function ($item) {
                return $item->getStringStatus();
            })
            ->addColumn('typology', function ($item) {
                if($item->page) {
                    return 'Page';
                }
                return isset($item->typology) ? ucfirst(strtolower($item->typology->name)) : null;
            })
            ->addColumn('author', function ($item) {
                return isset($item->author) ? $item->author->full_name : null;
            })
            ->addColumn('action', function ($item) {
                return '
                <a href="" id="item-'.$item->id.'" data-content="'.base64_encode($item->load('fields')->toJson()).'" class="btn btn-link add-item" data-type="'.( isset($item->typology) ? $item->typology->name : null ).'" data-name="'.$item->getField('title').'" data-id="'.$item->id.'"><i class="fa fa-plus"></i> Afegir</a> &nbsp;
                ';
            })
            ->make(true);
    }
}
