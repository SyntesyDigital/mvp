<?php

namespace Modules\RRHH\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Architecht\Repositories\Content\ContentRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        ContentRepository $contents
    ) {
        $this->contents = $contents;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('front.home', [
                'contents' => $this->contents->getBlogPosts(false, 2),
            ]);
    }
}
