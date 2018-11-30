<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\RRHH\Jobs\Tags\CreateTag;
//use Modules\RRHH\Http\Requests\Admin\SendTagRequest;

use Modules\RRHH\Jobs\Tags\DeleteTag;
use Modules\RRHH\Entities\Tag;
use Illuminate\Http\Request;

//use Modules\RRHH\Jobs\SendTag;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rrhh::admin.tags', [
            'tags' => Tag::all(),
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        if ($this->dispatchNow(CreateTag::fromRequest($name))) {
            return 'saved';
        } else {
            return 'error';
        }
    }

    public function delete(Request $request)
    {
        $name = $request->get('name');
        $tag = Tag::where('name', $name)->first();
        if ($this->dispatchNow(new DeleteTag($tag))) {
            return 'deleted';
        } else {
            return 'error';
        }
    }
}
