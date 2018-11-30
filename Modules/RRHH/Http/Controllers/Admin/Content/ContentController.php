<?php

namespace Modules\RRHH\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\Content\Content\CreateContentRequest;
use Modules\RRHH\Http\Requests\Admin\Content\Content\UpdateContentRequest;
use Modules\RRHH\Jobs\Content\Content\CreateContent;
use Modules\RRHH\Jobs\Content\Content\DeleteContent;
use Modules\RRHH\Jobs\Content\Content\UpdateContent;
use Modules\RRHH\Entities\Content\Content;
use Modules\RRHH\Repositories\Content\CategoryRepository;
use Modules\RRHH\Repositories\Content\ContentRepository;
use Modules\RRHH\Repositories\Content\LanguageRepository;
use Modules\RRHH\Repositories\Content\TypologyRepository;
use Session;

class ContentController extends Controller
{
    public function __construct(
        TypologyRepository $typologies,
        ContentRepository $contents,
        LanguageRepository $languages,
        CategoryRepository $categories
    ) {
        $this->contents = $contents;
        $this->typologies = $typologies;
        $this->languages = $languages;
        $this->categories = $categories;
    }

    public function index($identifier)
    {
        $typology = $this->typologies->findByField('identifier', $identifier)->first();

        return view('rrhh::admin.content.contents.index', [
            'contents' => $typology->contents,
            'typology' => $typology,
        ]);
    }

    public function show(Content $content)
    {
        $categories = $this->categories->findWhere([
            'status' => 1,
            'typology_id' => $content->typology->id,
        ])->mapWithKeys(function ($category) {
            return [$category->id => $category->name];
        });

        return view('rrhh::admin.content.contents.form', [
            'typology' => $content->typology,
            'languages' => $this->languages->all(),
            'content' => $content,
            'categories' => $categories,
        ]);
    }

    public function create($identifier)
    {
        $typology = $this->typologies->findByField('identifier', $identifier)->first();

        $categories = $this->categories->findWhere([
            'status' => 1,
            'typology_id' => $typology->id,
        ])->mapWithKeys(function ($category) {
            return [$category->id => $category->name];
        });

        return view('rrhh::admin.content.contents.form', [
            'typology' => $typology,
            'languages' => $this->languages->all(),
            'categories' => $categories,
        ]);
    }

    public function update(Content $content, UpdateContentRequest $request)
    {
        //dd($request->all());
        if ($content = $this->dispatchNow(new UpdateContent($content, $request->all()))) {
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } else {
            Session::flash('notify_error', "Une erreur s'est produite lors de la suppression");
        }

        return redirect()->route('admin.content.show', $content);
    }

    public function store(CreateContentRequest $request)
    {
        if ($content = $this->dispatchNow(new CreateContent($request->all()))) {
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } else {
            Session::flash('notify_error', "Une erreur s'est produite lors de la suppression");
        }

        return redirect()->route('admin.content.show', $content);
    }

    public function delete($id)
    {
        $content = $this->contents->find($id);

        if ($this->dispatchNow(new DeleteContent($content))) {
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } else {
            Session::flash('notify_error', "Une erreur s'est produite lors de la suppression");
        }

        return redirect()->route('admin.content.index.type', $content->typology->identifier);
    }
}
