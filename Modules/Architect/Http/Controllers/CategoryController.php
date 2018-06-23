<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Architect\Repositories\CategoryRepository;

use Modules\Architect\Http\Requests\Category\CreateCategoryRequest;
use Modules\Architect\Jobs\Category\CreateCategory;

use Modules\Architect\Http\Requests\Category\UpdateCategoryRequest;
use Modules\Architect\Jobs\Category\UpdateCategory;

use Modules\Architect\Http\Requests\Category\DeleteCategoryRequest;
use Modules\Architect\Jobs\Category\DeleteCategory;

// Models
use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\Typology;
use App\Models\User;
use App\Models\Role;

class CategoryController extends Controller
{

    public function __construct(CategoryRepository $categories) {
        $this->categories = $categories;
    }

    public function index(Request $request)
    {
        return view('architect::categories.index', [
            "typologies" => Typology::all(),
            "categories" => $this->categories->all()
        ]);
    }

    public function data(Request $request)
    {
        return $this->categories->getDatatable();
    }

    public function show(Category $category, Request $request)
    {
        return view('architect::categories.form', [
            'category' => $category,
        ]);
    }

    public function create(Request $request)
    {
        return view('architect::categories.form');
    }

    public function store(CreateCategoryRequest $request)
    {
        try {
            $category = dispatch_now(CreateCategory::fromRequest($request));

            if(!$category) {
                throw new \Exception('Error occured while saving...');
            }

            return redirect(route('categories.show', $category))->with('success', 'Category successfully saved');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        }

        return redirect(route('categories.create'))
            ->with('error', $error)
            ->withInput($request->input());
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        try {
            $category = dispatch_now(UpdateCategory::fromRequest($category, $request));

            if(!$category) {
                throw new \Exception('Error occured while saving...');
            }

            return redirect(route('categories.show', $category))->with('success', 'Category successfully saved');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
        }

        return redirect(route('categories.create'))
            ->with('error', $error)
            ->withInput($request->input());
    }

}