<?php

namespace Modules\RRHH\Repositories;

use Modules\RRHH\Entities\Offers\Offer;
use Modules\RRHH\Entities\Offers\Tags;
use Auth;
use Datatables;
use DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Lang;

class OfferRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\RRHH\\Entities\\Offers\Offer";

    }

    public function getDataTableData()
    {
        $offers = Offer::leftJoin('users', 'offers.recipient_id', '=', 'users.id')
             ->leftJoin('offers_fields', function ($join) {
                 $join->on('offers_fields.offer_id', '=', 'offers.id');
                 $join->where('offers_fields.name', '=', 'title');
             })
            ->select(
                'offers.*',
                'offers.id as offer_id',
                'users.firstname',
                'users.lastname',
                DB::raw('CONCAT(users.firstname," ",users.lastname) AS recipient_fullname'),
                DB::raw('
                    (SELECT COUNT(applications.id)
                    FROM applications
                    WHERE applications.offer_id = offers.id) as applied
                ')
            )
            //->groupBy('offers.id')
            ->with('fields');

        /*if (Auth::user()->hasRole('recruiter')) {
            $offers->where('offers.recipient_id', Auth::user()->id);
        }*/

        return Datatables::eloquent($offers)
            ->filterColumn('title', function ($query, $keyword) {
                if ($keyword) {
                    $query->where('offers_fields.value', 'LIKE', "%$keyword%");
                }
            })
            ->addColumn('title', function ($item) {
                return $item->title;
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword) {
                    $key_upper = strtoupper($keyword);
                    if (false === strpos('ACTIVE', $key_upper)) {
                        if (false === strpos('INACTIVE', $key_upper) && false === strpos('UNACTIVE', $key_upper)) {
                            //nothing to do
                        } else {
                            $status = Offer::STATUS_UNACTIVE;
                            $query->where('offers.status', $status);
                        }
                    } else {
                        $status = Offer::STATUS_ACTIVE;
                        $query->where('offers.status', $status);
                    }
                }
            })
            ->addColumn('status', function ($item) {
                return $item->getStringStatus();
            })
            ->addColumn('created_at', function ($item) {
                return $item->created_at;
            })
            // ->addColumn('applied', function ($item) {
            //     return $item->applications()->count();
            // })

            ->filterColumn('recipient', function ($query, $keyword) {
                if ($keyword) {
                    $query->whereRaw("recipient_id LIKE ? OR CONCAT(users.firstname,' ',users.lastname) like ?", ["%$keyword%", "%$keyword%"]);
                }
            })
            ->addColumn('recipient', function ($item) {
                return $item->recipient->full_name;
            })
            ->addColumn('applied', function ($item) {
                return '<a href="'.route('rrhh.admin.offer.applications.show', $item).'" class="btn btn-link"> <i class="fa fa-address-card"></i> '.$item->applications()->count().' </a>';
            })

            ->addColumn('action', function ($item) {
                $html = '';

                $html .= '&nbsp; <a title="'.Lang::get("architect::datatables.edit").'"  href="'.route('rrhh.admin.offers.show', $item).'" class="btn btn-link"><i class="fa fa-pencil"></i> </a>';

                if (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('recruiter') && $item->recipient_id == Auth::user()->id)) {
                    $html .= '&nbsp; <a  title="'.Lang::get("architect::datatables.delete").'" href="'.route('rrhh.admin.offers.delete', $item).'" data-ajax="'.route('rrhh.admin.offers.delete', $item).'" data-toogle="delete" data-confirm-message="Êtes-vous sur de vouloir supprimer cette offre ?" class="btn btn-link text-danger" ><i class="fa fa-trash"></i> </a>';
                }

                return $html;
            })

            ->rawColumns(['applied','action'])

            ->order(function ($query) {
                $orders = request()->get('order');
                $columns = request()->get('columns');

                // foreach ($orders as $order) {
                //     $column = $order['column'];
                //     $dir = $order['dir'];
                //
                //     switch ($columns[$column]['name']) {
                //         case 'id':
                //             $query->groupBy('offers.id')->orderBy('offers.id', $dir);
                //         break;
                //
                //         case 'title':
                //             $query->groupBy('offers_fields.id')->whereRaw('offers_fields.name = ?', [
                //                 'title',
                //             ])->orderBy('offers_fields.value', $dir);
                //         break;
                //
                //         case 'created_at':
                //             $query->groupBy('offers.id')->orderBy('offers.created_at', $dir);
                //         break;
                //
                //         case 'status':
                //             $query->groupBy('offers.id')->orderBy('offers.status', $dir);
                //         break;
                //
                //         case 'recipient':
                //             $query->groupBy('offers.id')->orderBy('recipient_fullname', $dir);
                //         break;
                //
                //         case 'applied':
                //             $query->groupBy('offers.id')->orderBy('applied', $dir);
                //         break;
                //     }
                // }
            })
        ->make(true);
    }

    public function getSearchOffers($search, $contract, $job, $agence, $itemsPerPage = null, $page = 0, $orderBy = null)
    {
        $qy = Offer::whereHas('fields', function ($q) use ($search, $contract, $job) {
            $q->where(function ($query) use ($search) {
                $query->where('name', 'title')
                    ->where('value', 'like', '%'.$search.'%');
            })
           ->orWhere(function ($query) use ($search) {
               $query->where('name', 'description')
                    ->where('value', 'like', '%'.$search.'%');
           })
           ->orWhere(function ($query) use ($search) {
               $query->where('name', 'address')
                    ->where('value', 'like', '%'.$search.'%');
           });
        })->where('status', Offer::STATUS_ACTIVE);

        if ($contract) {
            $qy->whereHas('fields', function ($q) use ($search, $contract) {
                $q->where(function ($query) use ($contract) {
                    $query->where('name', 'contract')
                        ->whereIn('value', $contract);
                });
            });
        }

        if ($job) {
            $qy->whereHas('fields', function ($q) use ($job) {
                $q->where(function ($query) use ($job) {
                    $query->where('name', 'job_1')
                        ->whereIn('value', $job);
                })
                ->orWhere(function ($query) use ($job) {
                    $query->where('name', 'job_2')
                        ->whereIn('value', $job);
                });
            });
        }

        if ($agence) {
            $qy->whereHas('recipient', function ($q) use ($agence) {
                $q->whereHas('agences', function ($q2) use ($agence) {
                    $q2->where(function ($query) use ($agence) {
                        $query->whereIn('id', $agence);
                    });
                });
            });
        }

        // Search tags
        if ($search) {
            $qy->orWhereHas('tags', function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                });
            });
        }

        if ($itemsPerPage) {
            $qy
                ->offset($itemsPerPage * $page)
                ->limit($itemsPerPage);
        }

        if($orderBy) {
            $qy->orderByField($orderBy, 'desc');
        }

        return $qy->get();
    }

    public function getRandomOffers($tags, $limit, $excluded_offer_id = null)
    {
        $offers = Offer::whereHas('tags', function ($query) use ($tags) {
              $query->whereIn('tags_offers.id', $tags);
          })
                  ->where('id', '!=', $excluded_offer_id)
                  ->where('status', Offer::STATUS_ACTIVE)
                  ->inRandomOrder()->limit($limit)->get();

        return $offers;
    }

    public function getRandomOffersByAgence($agence, $limit, $excluded_offer_id = null, $tags = null)
    {
        $offers = Offer::leftJoin('users', 'offers.recipient_id', '=', 'users.id')
            ->leftJoin('offers_fields', 'offers_fields.offer_id', '=', 'offers.id')
            ->leftJoin('agence_user', 'agence_user.user_id', '=', 'users.id')
            ->select(
                'offers.*'
            )
            ->where('agence_user.agence_id', $agence)
            ->where('offers.status', Offer::STATUS_ACTIVE);

        if ($tags) {
            $offers->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('tags.id', $tags);
            });
        }

        if ($excluded_offer_id) {
            $offers->where('offers.id', '!=', $excluded_offer_id);
        }

        return $offers->inRandomOrder()
                  ->groupBy('offers.id')
                  ->with('fields')
                  ->limit($limit)
                  ->get();
    }
}
