<?php

namespace Modules\RRHH\Repositories;

use Modules\RRHH\Entities\Offers\Application;
use Datatables;
use DB;
use Form;
use Prettus\Repository\Eloquent\BaseRepository;
use Lang;

class ApplicationRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\RRHH\\Entities\\Offers\Application";
    }

    public function getSpontaneousDatatable()
    {
        $applications = Application::leftJoin('candidates', 'applications.candidate_id', '=', 'candidates.id')
            ->leftJoin('users', 'candidates.user_id', '=', 'users.id')
            ->select(
                'applications.*',
                'users.firstname',
                'users.lastname',
                'candidates.postal_code AS postal_code',
                'candidates.location AS location',
                'candidates.type AS candidate_type',
                 DB::raw('CONCAT(users.firstname," ",users.lastname) AS candidate_fullname')
            )
            ->where('applications.type', Application::TYPE_SPONTANEOUS);

        return Datatables::eloquent($applications)
            ->filterColumn('candidate', function ($query, $keyword) {
                $query->whereRaw("CONCAT(users.firstname,' ',users.lastname) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('candidate', function ($item) {
                return $item->firstname.' '.$item->lastname;
            })

            ->filterColumn('candidate_type', function ($query, $keyword) {
                $query->whereRaw('candidates.type LIKE ?', ["%$keyword%"]);
            })
            ->addColumn('candidate_type', function ($item) {
                return $item->candidate->getTypeString();
            })
            ->addColumn('postal_code', function ($item) {
                return $item->postal_code;
            })
            ->filterColumn('postal_code', function ($query, $keyword) {
                $query->whereRaw('candidates.postal_code LIKE ?', ["%$keyword%"]);
            })
            ->addColumn('location', function ($item) {
                return $item->location;
            })
            ->filterColumn('location', function ($query, $keyword) {
                $query->whereRaw('candidates.location LIKE ?', ["%$keyword%"]);
            })

            ->addColumn('done_at', function ($item) {
                return $item->done_at;
            })

            ->addColumn('status', function ($item) {
                return Form::select('status', $item->getStatus(), $item->status, [
                    'data-url' => route('rrhh.admin.applications.spontaneous.update.status'),
                    'data-id' => $item->id,
                    'data-toogle' => 'save-onchange',
                ]);
            })

            ->addColumn('action', function ($item) {
                return '
                    <a title="'.Lang::get("architect::datatables.view_candidate").'" href="'.route('rrhh.admin.candidates.show', $item->candidate->user).'" class="btn btn-link"><i class="fa fa-user"></i></a> &nbsp;
                    <a title="'.Lang::get("architect::datatables.delete").'" href="#" class="btn btn-link text-danger" data-toogle="delete" data-ajax="'.route('rrhh.admin.applications.delete', $item).'" data-confirm-message="Êtes-vous sûr de vouloir supprimer cette candidature ?"><i class="fa fa-trash"></i></a>
                ';
            })

            ->order(function ($query) {
                $orders = request()->get('order');
                $columns = request()->get('columns');

                foreach ($orders as $order) {
                    $column = $order['column'];
                    $dir = $order['dir'];

                    switch ($columns[$column]['name']) {
                        case 'id':
                            $query->groupBy('applications.id')->orderBy('applications.id', $dir);
                        break;

                        case 'done_at':
                            $query->groupBy('applications.id')->orderBy('applications.done_at', $dir);
                        break;

                        case 'status':
                            $query->groupBy('applications.id')->orderBy('applications.status', $dir);
                        break;

                        case 'candidate':
                            $query->groupBy('applications.id')->orderBy('candidate_fullname', $dir);
                        break;
                        case 'candidate_type':
                            $query->groupBy('applications.id')->orderBy('candidate_type', $dir);
                        break;
                    }
                }
            })
        ->make(true);
    }

    public function getDatatable()
    {
        $applications = Application::leftJoin('candidates', 'applications.candidate_id', '=', 'candidates.id')
            ->leftJoin('users', 'candidates.user_id', '=', 'users.id')
            ->leftJoin('offers', 'offers.id', '=', 'applications.offer_id')
            ->leftJoin('offers_fields', 'offers.id', '=', 'offers_fields.offer_id')
            ->select(
                'applications.*',
                'users.firstname',
                'users.lastname',
                // 'offers.id as offer_id',
                'candidates.type AS candidate_type',
                DB::raw('CONCAT(users.firstname," ",users.lastname) AS candidate_fullname')
            )
            ->where('applications.type', Application::TYPE_OFFER)
            ->with('offer')
            ->groupBy('applications.id');
        //->groupBy('id');

        return Datatables::eloquent($applications)
            ->filterColumn('candidate', function ($query, $keyword) {
                $query->whereRaw("CONCAT(users.firstname,' ',users.lastname) like ?", ["%{$keyword}%"]);
            })

            ->addColumn('candidate', function ($item) {
                return $item->firstname.' '.$item->lastname;
            })

            ->filterColumn('candidate_type', function ($query, $keyword) {
                $query->whereRaw('candidates.type LIKE ?', ["%$keyword%"]);
            })
            ->addColumn('candidate_type', function ($item) {
                return $item->candidate->getTypeString();
            })

            ->filterColumn('offer', function ($query, $keyword) {
                $query->whereRaw('offers_fields.name = "title" AND offers_fields.value LIKE ?', ["%$keyword%"]);
            })

            ->addColumn('offer', function ($item) {
                return isset($item->offer) ? $item->offer->title : null;
            })

            ->addColumn('done_at', function ($item) {
                return $item->done_at;
            })

            ->addColumn('status', function ($item) {
                return $item->getStatusString();
            })

            // TODO : FIX filters :)
            // ->filterColumn('status', function ($query, $keyword) {
            //     $status = null;
            //     foreach(Application::getStatus() as $k => $v) {
            //         if($v == $keyword) {
            //             $status = $k;
            //         }
            //     }
            //
            //     //$query->whereRaw('applications.status =', $status);
            // })

            ->addColumn('action', function ($item) {
                return '
                    <a title="'.Lang::get("architect::datatables.process").'" href="'.route('rrhh.admin.offer.applications.show', $item->offer_id).'" class="btn btn-link"><i class="fa fa-pencil"></i></a> &nbsp;
                    <a title="'.Lang::get("architect::datatables.view_profile").'" href="'.route('rrhh.admin.candidates.show', $item->candidate->user).'" class="btn btn-link"><i class="fa fa-user"></i></a> &nbsp;
                    <a title="'.Lang::get("architect::datatables.delete").'" href="#" class="btn btn-link text-danger" data-ajax="'.route('rrhh.admin.applications.delete', $item).'" data-toogle="delete" data-confirm-message="Êtes-vous sûr de vouloir supprimer cette candidature ?"><i class="fa fa-trash"></i></a>
                ';
            })

            ->order(function ($query) {
                $orders = request()->get('order');
                $columns = request()->get('columns');

                foreach ($orders as $order) {
                    $column = $order['column'];
                    $dir = $order['dir'];

                    switch ($columns[$column]['name']) {
                        case 'id':
                            $query->groupBy('applications.id')->orderBy('applications.id', $dir);
                        break;

                        case 'done_at':
                            $query->groupBy('applications.id')->orderBy('applications.done_at', $dir);
                        break;

                        case 'status':
                            $query->groupBy('applications.id')->orderBy('applications.status', $dir);
                        break;

                        case 'candidate':
                            $query->groupBy('applications.id')->orderBy('candidate_fullname', $dir);
                        break;

                        case 'candidate_type':
                            $query->groupBy('applications.id')->orderBy('candidate_type', $dir);
                        break;

                        case 'offer':
                            $query->whereRaw('offers_fields.name = ?', [
                                'title',
                            ])->orderBy('offers_fields.value', $dir);
                        break;
                    }
                }
            })

        ->make(true);
    }
}
