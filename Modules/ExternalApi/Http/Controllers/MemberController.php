<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ExternalApi\Collections\MemberCollection;
use Modules\ExternalApi\Repositories\MemberRepository;

class MemberController extends Controller
{
    public function __construct(MemberRepository $members)
    {
        $this->members = $members;
    }

    public function all(Request $request)
    {
        $this->members->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria')); // Check Request Criteria https://github.com/andersao/l5-repository

        return new MemberCollection($this->members->paginate(20));
    }
}
