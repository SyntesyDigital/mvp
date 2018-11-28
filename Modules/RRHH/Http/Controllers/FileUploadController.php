<?php

namespace Modules\RRHH\Http\Controllers;

use Modules\RRHH\Repositories\ImageUploadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FileUploadController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(ImageUploadRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Function to process upload from dropzone and save it to tmp.
     */
    public function postUpload(Request $request)
    {
        $result = $this->repository->upload(
            $request->all(),
            $request->exists('resizeWidth') ? $request->get('resizeWidth') : null
        );

        return $result['error'] ? Response::json($result, 500) : Response::json($result, 200);
    }

    public function deleteUpload(Request $request)
    {
        //$request->get('filename');
        $filename = '';

        if ($this->repository->delete($filename)) {
            return Response::json([
                'error' => false,
                'code' => 200,
            ], 200);
        }

        return Response::json([
            'error' => false,
            'message' => 'Server error while uploading',
            'code' => 500,
        ], 500);
    }
}
