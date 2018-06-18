<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Architect\Repositories\ContentRepository;

use Modules\Architect\Http\Requests\Content\CreateContentRequest;
use Modules\Architect\Jobs\Content\CreateContent;

use Modules\Architect\Http\Requests\Content\UpdateContentRequest;
use Modules\Architect\Jobs\Content\UpdateContent;

use Modules\Architect\Http\Requests\Content\DeleteContentRequest;
use Modules\Architect\Jobs\Content\DeleteContent;

// Models
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Content;
use App\Models\User;
use App\Models\Role;

use Modules\Architect\Fields\FieldsReactAdapter;

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

    public function modalData(Request $request)
    {
        $where = $request->get('typology_id') ? [
            'typology_id' => $request->get('typology_id')
        ] : null;

        return $this->contents->getModalDatatable($where);
    }

    public function show(Content $content, Request $request)
    {
        $content->typology->load('fields');

        print_R((new FieldsReactAdapter($content))->get()->toJson(JSON_PRETTY_PRINT));
        exit();

        return view('architect::contents.show', [
            'content' => $content,
            'typology' => $content->typology,
            'fields' => (new FieldsReactAdapter($content))->get(),
            'users' => User::all(),
        ]);
    }

    public function create(Typology $typology, Request $request)
    {
        return view('architect::contents.show', [
            'typology' => $typology->load('fields'),
            'fields' => (new FieldsReactAdapter($typology))->get(),
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

    public function delete(Content $content, DeleteContentRequest $request)
    {
        return dispatch_now(DeleteContent::fromRequest($content, $request)) ? response()->json([
            'success' => true
        ]) : response()->json([
            'success' => false
        ], 500);
    }

}
