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
use Modules\Architect\Entities\Tag;
use Modules\Architect\Entities\Category;
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

        if($request->get('display_pages')) {
            $where = [
                ['page_id','<>', null]
            ];
        }

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
        if($content->typology) {
            $content->typology->load('fields');
        }

        return view('architect::contents.show', [
            'content' => $content->load('tags', 'categories'),
            'typology' => $content->typology,
            'fields' => (new FieldsReactAdapter($content))->get(),
            'users' => User::all(),
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function create(Typology $typology, Request $request)
    {
        return view('architect::contents.show', [
            'typology' => $typology->load('fields'),
            'fields' => (new FieldsReactAdapter($typology))->get(),
            'users' => User::all(),
            'tags' => Tag::all(),
            'categories' => Category::all()
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
