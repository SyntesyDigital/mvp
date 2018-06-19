<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Architect\Repositories\tagRepository;

use Modules\Architect\Http\Requests\tag\CreateTagRequest;
use Modules\Architect\Jobs\tag\CreateTag;

use Modules\Architect\Http\Requests\tag\UpdateTagRequest;
use Modules\Architect\Jobs\tag\UpdateTag;

use Modules\Architect\Http\Requests\tag\DeleteTagRequest;
use Modules\Architect\Jobs\tag\DeleteTag;

// Models
use Modules\Architect\Entities\Tag;
use App\Models\User;
use App\Models\Role;

class TagController extends Controller
{

    public function __construct(TagRepository $tags) {
        $this->tags = $tags;
    }

    public function index(Request $request)
    {
        return view('architect::tags.index', [
            "tags" => $this->tags->all()
        ]);
    }

    public function data(Request $request)
    {
        return $this->tags->getDatatable();
    }

    public function show(Tag $tag, Request $request)
    {
        return view('architect::tags.form', [
            'tag' => $tag,
        ]);
    }

    public function create(Request $request)
    {
        return view('architect::tags.form');
    }

    public function store(CreateTagRequest $request)
    {
        try {
            $tag = dispatch_now(CreateTag::fromRequest($request));

            if(!$tag) {
                throw new \Exception('Error occured while saving...');
            }

            return redirect(route('tags.show', $tag))->with('success', 'Tag successfully saved');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        }

        return redirect(route('tags.create'))->with('error', $error);
    }

    public function update(Tag $tag, UpdateTagRequest $request)
    {
        try {
            $tag = dispatch_now(UpdateTag::fromRequest($tag, $request));

            if(!$tag) {
                throw new \Exception('Error occured while saving...');
            }

            return redirect(route('tags.show', $tag))->with('success', 'Tag successfully saved');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        }

        return redirect(route('tags.show', $tag))->with('error', $error);
    }

}
