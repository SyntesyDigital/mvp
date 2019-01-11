<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Modules\RRHH\Http\Requests\Admin\SendTagRequest;
//use Modules\RRHH\Jobs\SendTag;

use Modules\RRHH\Http\Requests\Admin\Tags\UpdateTagRequest;
use Modules\RRHH\Http\Requests\Admin\Tags\CreateTagRequest;

use Modules\RRHH\Jobs\Tags\CreateTag;
use Modules\RRHH\Jobs\Tags\UpdateTag;
use Modules\RRHH\Jobs\Tags\DeleteTag;
use Modules\RRHH\Entities\Tag;

use Modules\RRHH\Repositories\TagRepository;

use Session;

class TagController extends Controller
{
    public function __construct(TagRepository $tags)
    {
        $this->middleware('auth');
        $this->tags = $tags;
    }

    public function index()
    {
        return view('rrhh::admin.tags.index');
    }

    public function data()
    {
        return $this->tags->getDataTableData();
    }

    public function create()
    {
        return view('rrhh::admin.tags.form');
    }

    public function show(Tag $tag, Request $request)
    {
        return view('rrhh::admin.tags.form', [
            'tag' => $tag
        ]);
    }

    public function update(Tag $tag, UpdateTagRequest $request)
    {
        try {
            $this->dispatchNow(UpdateTag::fromRequest($tag, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.tags.show', $tag);
    }

    public function store(CreateTagRequest $request)
    {
        try {
            $tag = $this->dispatchNow(CreateTag::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('rrhh.admin.tags.show', $tag);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.tags.create')->withInput();
    }

    public function delete(Tag $tag, Request $request)
    {
        if ($this->dispatchNow(new DeleteTag($tag))) {
            return response()->json([
                'success' => true
            ], 200);
        }

        return response()->json([
            'success' => true
        ], 500);
    }
}
