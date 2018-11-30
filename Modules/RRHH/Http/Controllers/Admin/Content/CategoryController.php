<?php

namespace Modules\RRHH\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\Content\Category\CreateCategoryRequest;
use Modules\RRHH\Http\Requests\Admin\Content\Category\UpdateCategoryRequest;
use Modules\RRHH\Jobs\Content\Category\CreateCategory;
use Modules\RRHH\Jobs\Content\Category\UpdateCategory;
use Modules\RRHH\Entities\Content\Category;
use Modules\RRHH\Entities\Language;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // FIXME : use repository
        $categories = Category::with([
            'fields' => function ($q) use ($request) {
                if ($request->language_id) {
                    $q->where('language_id', $request->language_id);
                }
            },
        ]);

        $data = [
            'categories' => $categories->paginate(20),
        ];

        return $request->ajax()
            ? response()->json($data)
            : view('rrhh::admin.content.categories.index', $data);
    }

    public function show(Request $request, $id)
    {
        $category = Category::find($id);
        $category->load('fields');

        $data = [
            'category' => $category,
            'categories' => Category::all(),
            'languages' => Language::all(),
        ];

        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('rrhh::admin.content.categories.form', $data);
    }

    public function create(Request $request)
    {
        return view('rrhh::admin.content.categories.form', [
            'languages' => Language::all(),
            'categories' => Category::all(),
        ]);
    }

    /*
     *  Process update on new category
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        try {
            $this->dispatchNow(UpdateCategory::fromRequest($category, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.content.categories.show', $category);
    }

    /*
     *  Store new category
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            $category = $this->dispatchNow(CreateCategory::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('admin.content.categories.show', $category);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('admin.content.categories.create');
    }

    public function destroy(Request $request, $id)
    {
        // // Retrieve category
        // $category = Category::find($id);
        //
        // if(!$category) {
        //     Session::flash('flash_error', 'This category not exist or already deleted');
        //     return redirect()->action('\Modules\Architect\Http\Controllers\CategoryController@index');
        // }
        //
        // $parent_id = $category->parent_id;
        //
        // // Remove category fields
        // $category->fields()->delete();
        //
        // // Remove category
        // if($category->delete() > 0) {
        //
        //     // Update child categories
        //     DB::table((new Category())->getTable())
        //         ->where('parent_id', $id)
        //         ->update(array('parent_id' => $parent_id));
        //
        //
        //     // Detach content with deleted category
        //     $attrs = ContentAttribut::where("name", "category")
        //                 ->where("value", $id);
        //
        //     if($attrs) {
        //         $attrs->delete();
        //     }
        //
        //     Session::flash('flash_success', 'Category deleted with success');
        //     return redirect()->action('\Modules\Architect\Http\Controllers\CategoryController@index');
        // }
        //
        // Session::flash('flash_error', 'Error while deleting the category');
        //
        // return redirect()->action('\Modules\Architect\Http\Controllers\CategoryController@show', $id);
    }
}
