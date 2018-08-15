<?php

namespace Modules\TurismeExternal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TurismeExternal\Collections\MemberCollection;
use Modules\TurismeExternal\Repositories\MemberRepository;

class MemberController extends Controller
{

    public function __construct(MemberRepository $members)
    {
        $this->members = $members;
    }

    public function index(Request $request)
    {

        // Check Request Criteria https://github.com/andersao/l5-repository
        $this->members->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        return new MemberCollection($this->members->paginate(20));
    }
}
