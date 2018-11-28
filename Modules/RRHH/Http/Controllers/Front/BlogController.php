<?php

namespace Modules\RRHH\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Front\BlogSearchRequest;
use Modules\RRHH\Entities\Content\Category;
use Modules\RRHH\Entities\Content\Content;
use Modules\RRHH\Entities\Content\Typology;
use Modules\RRHH\Repositories\Content\CategoryRepository;
use Modules\RRHH\Repositories\Content\ContentRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        ContentRepository $contents,
        CategoryRepository $categories
    ) {
        $this->contents = $contents;
        $this->categories = $categories;
        $this->posts_per_page = 4;
    }

    public function index(Request $request)
    {
        $typology = Typology::byIdentifier('news')->first();

        return view('front.blog.index', [
            'num_contents' => count($this->contents->getBlogPosts()),
            'contents_per_page' => $this->posts_per_page,
            'contents' => $this->contents->orderBy('id', 'desc')->getBlogPosts(false, $this->posts_per_page, $request->get('offset') ? $request->get('offset') : 0),
            'categories' => $this->categories->findWhere([
            'status' => 1,
            'typology_id' => $typology->id,
            ])->all(),
        ]);
    }

    public function show($category_slug, $content_slug)
    {
        $typology = Typology::byIdentifier('news')->first();
        $content = Content::getBySlug($content_slug)->first();
        $category = Category::getByslug($category_slug);

        if (! $content) {
            abort(404);
        }
        if (! $category) {
            abort(404);
        }
        if (! in_array($category->id, $content->getCategoriesIds())) {
            abort(404);
        }
        $othersContents = Content::whereCategory($content->getCategoriesIds())
            ->with('fields')
            ->where('id', '<>', $content->id)
            ->where('status', 1)
            ->get();

        return view('front.blog.post', [
            'content' => $content,
            'categories' => $this->categories->findWhere([
            'status' => 1,
            'typology_id' => $typology->id,
            ])->all(),
            'category_slug' => $category_slug,
            'othersContents' => $othersContents,
        ]);
    }

    public function category($slug, $offset = 0)
    {
        $category = Category::whereField('slug', $slug)->first();
        $typology = Typology::byIdentifier('news')->first();

        return view('front.blog.index', [
           'num_contents' => count($category ? $category->contents()->get() : 0),
           'contents_per_page' => $this->posts_per_page,
           'category_selected' => $category,
           'contents' => $category ? $category->contents()->orderBy('id', 'desc')->skip($offset)->take($this->posts_per_page)->get() : null,
           'categories' => $this->categories->findWhere([
               'status' => 1,
               'typology_id' => $typology->id,
           ])->all(),
       ]);
    }

    // public function search(BlogSearchRequest $request)
    // {
    //     return view('front.blog.results', [
    //         'contents' => $this->contents->getSearchContents($request->get('search')),
    //         'search' => $request->get('search'),
    //         ]);
    // }
}
