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

class MediaController extends Controller
{

    public function __construct(MediaRepository $medias) {
        $this->medias = $medias;
    }

    public function index()
    {
        return view('architect::medias.index');
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
        //return $this->dispatchNow(CreateMedia::fromRequest($request));
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

    public function delete($id)
    {
        // if ($this->dispatchNow(new DeleteMedia($this->medias->find($id)))) {
        //     Session::flash('notify_success', 'Enregistrement effectué avec succès');
        // } else {
        //     Session::flash('notify_error', "Une erreur s'est produite lors de la suppression");
        // }
        //
        // return redirect()->route('admin.content.medias.index');
    }

}
