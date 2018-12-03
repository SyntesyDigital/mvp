<?php

namespace Modules\RRHH\Repositories;

use Modules\RRHH\Entities\Offers\Candidate;
use App\Models\User;
use Datatables;
use Prettus\Repository\Eloquent\BaseRepository;

class CandidateRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\RRHH\\Entities\\Offers\Candidate";
    }

    public function getDatatableData($roles, $tags = null)
    {
        if (null !== $tags) {
            $tags = str_replace(['[', ']', '"'], '', $tags);
            if ('' != $tags) {
                $tags = explode(',', $tags);
            } else {
                $tags = null;
            }
        } else {
            $tags = null;
        }

        $candidates = Candidate::leftJoin('users', 'users.id', '=', 'candidates.user_id')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->select(
                'users.id',
                'users.firstname',
                'users.lastname',
                'users.status',
                'candidates.type',
                'candidates.postal_code',
                'candidates.location',
                'roles.name',
                'roles.display_name'
            );

        if (is_array($roles)) {
            $candidates->whereIn('roles.name', $roles);
        } else {
            $candidates->where('roles.name', $roles);
        }

        if (null != $tags) {
            $candidates->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('tags.name', $tags);
            });
        }

        return Datatables::eloquent($candidates)

            ->filterColumn('lastname', function ($query, $keyword) {
                if ($keyword) {
                    $query->whereRaw("CONCAT(users.lastname,' ',users.firstname) like ?", ["%$keyword%"]);
                }
            })

            ->addColumn('lastname', function ($item) {
                return $item->lastname.' '.$item->firstname;
            })
            ->filterColumn('type', function ($query, $keyword) {
                $query->whereRaw('candidates.type LIKE ?', ["%$keyword%"]);
            })

            ->filterColumn('postal_code', function ($query, $keyword) {
                $query->whereRaw('candidates.postal_code LIKE ?', ["%$keyword%"]);
            })

            ->filterColumn('location', function ($query, $keyword) {
                $query->whereRaw('candidates.location LIKE ?', ["%$keyword%"]);
            })

            ->addColumn('type', function ($item) {
                return $item->getTypeString();
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword) {
                    $query->whereRaw('users.status LIKE ?', ["%$keyword%"]);
                }
            })
            ->addColumn('status', function ($item) {
                $status = User::getStatus();

                return isset($status[$item->status]) ? $status[$item->status] : null;
            })
            ->addColumn('action', function ($item) {
                return '<a href="'.route('rrhh.admin.candidates.show', $item).'" class="btn btn-sm btn-success pull-right">Modifier</a>';
            })

            ->order(function ($query) {
                $orders = request()->get('order');
                $columns = request()->get('columns');

                foreach ($orders as $order) {
                    $column = $order['column'];
                    $dir = $order['dir'];

                    switch ($columns[$column]['name']) {
                        case 'id':
                            $query->orderBy('candidates.id', $dir);
                        break;

                        case 'type':
                            $query->orderBy('candidates.type', $dir);
                        break;

                        case 'status':
                            $query->orderBy('users.status', $dir);
                        break;

                        case 'lastname':
                            $query->orderBy('users.lastname', $dir);
                        break;
                        case 'firstname':
                            $query->orderBy('users.firstname', $dir);
                        break;
                    }
                }
            })
        ->make(true);
    }
}
