<?php

namespace Modules\RRHH\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Candidate\CandidateCVRequest;
use Modules\RRHH\Http\Requests\Candidate\CandidateFrontRequest;
use Modules\RRHH\Http\Requests\Candidate\CandidateLoginRequest;
use Modules\RRHH\Jobs\Candidate\RegisterCandidate;
use Modules\RRHH\Jobs\Candidate\UploadCVCandidate;
use Modules\RRHH\Jobs\Tags\SaveCandidateTags;
use Modules\RRHH\Entities\Tag;
use Modules\RRHH\Entities\User;
use Modules\RRHH\Repositories\UserRepository;
use Auth;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function login(CandidateLoginRequest $request)
    {
        $data = [];
        $httpCode = 500;
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            $httpCode = 200;
            $data = ['user_id' => Auth::user()->id,
                     'resume_file' => Auth::user()->candidate->resume_file, ];
        } else {
            $httpCode = 304;
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ], $httpCode);
    }

    public function store(CandidateFrontRequest $request)
    {
        $data = [];
        $httpCode = 500;
        try {
            $candidate = $this->dispatchNow(RegisterCandidate::fromRequest($request));
            $data = ['user_id' => Auth::user()->id];
            $httpCode = 200;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            dd($message);
        }

        return response()->json([
           'success' => true,
           'data' => $data,
        ], $httpCode);
    }

    public function addcv(CandidateCVRequest $request)
    {
        $data = [];
        $httpCode = 500;
        try {
            $path = $this->dispatchNow(UploadCVCandidate::fromRequest($request));
            $data = ['resume_file' => Auth::user()->candidate->resume_file];
            $httpCode = 200;
        } catch (\Exception $e) {
        }

        return response()->json([
                   'success' => true,
                   'data' => $data,
                ], $httpCode);
    }

    public function addtag(Request $request)
    {
        $httpCode = 500;
        $message = null;
        $user = Auth::user();

        try {
            if (! $user) {
                throw new \Exception('Vous devez être connecté');
            }

            $this->dispatchNow(new SaveCandidateTags($user, $request->input('tag')));
            $httpCode = 200;
        } catch (\Exception $e) {
            switch ($e->getCode()) {
               case SaveCandidateTags::EXCEPTION_ALREADY_APPLIED:
                    $httpCode = 304;
                    $message = 'Vous avez déjà postulé';
                    break;
               default:
                    $message = $e->getMessage();
                    break;
            }
        }

        return response()->json([
            'success' => true,
            'message' => null,
            'data' => [],
        ], $httpCode);
    }
}
