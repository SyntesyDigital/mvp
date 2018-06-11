<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Architect\Repositories\ContentRepository;

// Requests
use Modules\Architect\Http\Requests\Content\CreateContentRequest;
use Modules\Architect\Jobs\Content\CreateContent;

// Jobs
use Modules\Architect\Http\Requests\Content\UpdateContentRequest;
use Modules\Architect\Jobs\Content\UpdateContent;

// Models
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Content;
use App\Models\User;
use App\Models\Role;

class ContentController extends Controller
{

    public function __construct(ContentRepository $contents) {
        $this->contents = $contents;
    }

    public function index(Request $request)
    {
        return view('architect::contents.index', [
            "typologies" => Typology::all()
        ]);
    }

    public function data(Request $request)
    {
        $where = $request->get('typology_id') ? [
            'typology_id' => $request->get('typology_id')
        ] : null;

        return $this->contents->getDatatable($where);
    }

    public function show(Content $content, Request $request)
    {
        return view('architect::contents.show', [
            'content' => $content->load('fields'),
            'typology' => $content->typology->load('fields'),
            'users' => User::all(),
        ]);
    }

    public function create(Typology $typology, Request $request)
    {
        return view('architect::contents.show', [
            'typology' => $typology->load('fields'),
            'users' => User::all()
        ]);
    }

    public function store(CreateContentRequest $request)
    {
        $content = dispatch_now(CreateContent::fromRequest($request));

        return $content ? response()->json([
            'success' => true,
            'content' => $content
        ]) : response()->json([
            'success' => false
        ], 500);
    }

    public function update(Content $content, CreateContentRequest $request)
    {
        $content = dispatch_now(UpdateContent::fromRequest($content, $request));

        return $content ? response()->json([
            'success' => true,
            'content' => $content
        ]) : response()->json([
            'success' => false
        ], 500);
    }

}
