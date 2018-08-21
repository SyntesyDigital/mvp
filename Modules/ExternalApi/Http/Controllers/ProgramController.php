<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\ExternalApi\Collections\MemberCollection;
use Modules\ExternalApi\Collections\ProgramCollection;

use Modules\ExternalApi\Repositories\MemberRepository;
use Modules\ExternalApi\Repositories\ProgramRepository;

class ProgramController extends Controller
{

    public function __construct(MemberRepository $members, ProgramRepository $programs)
    {
        $this->members = $members;
        $this->programs = $programs;
    }

    public function all(Request $request)
    {
        $this->programs->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria')); // Check Request Criteria https://github.com/andersao/l5-repository

        return new ProgramCollection($this->programs->all());
    }

    public function members($code, Request $request)
    {
        // FIXME : user --> $this->members->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria')); // Check Request Criteria https://github.com/andersao/l5-repository
        $program = $this->programs->getByCode($code);

        $collection = $program->members();

        if($request->get('order')) {
            $order = explode(',', $request->get('order'));
            $column = isset($order[0]) ? $order[0] : null;
            $sens = isset($order[1]) ? $order[1] : null;

            if($column && $sens) {
                $collection->orderBy($column, $sens);
            }


        }

        return new MemberCollection($collection->paginate(10));
    }
}
