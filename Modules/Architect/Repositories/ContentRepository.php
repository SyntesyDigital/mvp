<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use DataTables;
use Storage;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Field;

use Modules\Architect\Repositories\Criterias\ModalDatatableCriteria;

class ContentRepository extends BaseRepository
{
    protected $fieldSearchable = [
    	'typology_id',
        'author_id',
        'parent_id',
        'is_page',
        'published_at',
        'typology.identifier',
        'typology.has_categories',
        'typology.has_tags',
        'typology.has_slug'
    ];

    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

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
            ->groupBy('contents.id')
            ->orderBy('contents.updated_at','DESC');

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

        // Array of all entryTitle
        $fields = Field::where('settings', 'LIKE', '%"entryTitle":true%')->get();
        $titleFields = ['title'];

        if($fields) {
            foreach($fields as $k => $v) {
                if(!in_array($v->identifier, $titleFields)) {
                    $titleFields[] = $v->identifier ;
                }
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
                $query->whereRaw("
                    contents_fields.value LIKE '%{$keyword}%'
                    AND contents_fields.name IN ('".implode(",", $titleFields)."')
                ");
            })
            ->addColumn('title', function ($item) {
                $title = isset($item->title) ? $item->title : '';

                if($item->is_page){
                  if(isset($item->parent)){
                    $parent = $item->parent()->first();
                    $title = ( $parent->title ? $parent->title.' / ' : '' ) . $title;
                  }
                }

                return $title;
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

    public function getModalDatatable()
    {
        $query = $this
            ->skipCriteria()
            ->pushCriteria(new ModalDatatableCriteria())
            ->orderBy('updated_at','DESC')
            ->all();

        return Datatables::of($query)
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
