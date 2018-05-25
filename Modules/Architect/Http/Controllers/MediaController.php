<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Architect\Repositories\MediaRepository;

use Modules\Architect\Http\Requests\Media\CreateMediaRequest;
use Modules\Architect\Http\Requests\Media\DeleteMediaRequest;

use Modules\Architect\Jobs\Media\DeleteMedia;
use Modules\Architect\Jobs\Media\CreateMedia;
use Illuminate\Support\Facades\Bus;

use Session;

class MediaController extends Controller
{

    public function __construct(MediaRepository $medias) {
        $this->medias = $medias;
    }

    public function index()
    {
        return view('architect::medias.index');
    }

    public function data()
    {
        return $this->medias->getDatatable();
    }

    // public function index(Request $request)
    // {
    //     $medias = $this->medias->orderBy('id', 'desc')->paginate(10);
    //
    //     return $request->ajax()
    //         ? response()->json($medias)
    //         : view('admin.content.medias.index', [
    //             'medias' => $medias,
    //         ]);
    // }

    public function create()
    {
    }

    public function store(CreateMediaRequest $request)
    {
        $media = dispatch_now(CreateMedia::fromRequest($request));

        return $media ? response()->json([
            'success' => true,
            'response' => $media
        ]) : response()->json([
            'success' => false
        ], 500);
    }

    public function show($id, Request $request)
    {
        // return $request->ajax()
        //     ? $this->medias->find($id)
        //     : view('admin.content.medias.show', [
        //         'media' => $this->medias->find($id),
        //     ]);
    }

    public function update(Request $request, $id)
    {
    }

    public function delete($id, Request $request)
    {
        if (dispatch_now(new DeleteMedia($this->medias->find($id)))) {
            return $request->ajax()
                ? response()->json([
                    'success' => true,
                    'message' => 'Media deleted with success'
                ]) : redirect()->route('admin.content.medias.index');
        }

        return $request->ajax()
            ? response()->json([
                'error' => true,
                'message' => 'An error occured when deleting media'
            ], 500)
            : redirect()->route('admin.content.medias.index');
    }

}
