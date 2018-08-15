<?php

namespace Modules\TurismeExternal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\TurismeExternal\Collections\MemberCollection;
use Modules\TurismeExternal\Repositories\MemberRepository;
use Modules\TurismeExternal\Repositories\ProgramRepository;

class ProgramController extends Controller
{

    public function __construct(MemberRepository $members, ProgramRepository $programs)
    {
        $this->members = $members;
        $this->programs = $programs;
    }

    public function index()
    {
        return view('turismeexternal::index');
    }

    public function members($code, Request $request)
    {
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
