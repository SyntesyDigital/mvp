<?php

namespace Modules\RRHH\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\RRHH\Jobs\Candidate\CreateCandidate;
use Modules\RRHH\Jobs\Candidate\CreateFile;
use Modules\RRHH\Jobs\Candidate\DeleteCandidate;
use Modules\RRHH\Jobs\Candidate\UpdateCandidate;
use Modules\RRHH\Jobs\Tags\UpdateCandidateTags;

use Modules\RRHH\Http\Requests\Admin\Candidate\CandidateRequest;
use Modules\RRHH\Http\Requests\Admin\Candidate\CreateFileRequest;

use Modules\RRHH\Entities\Offers\Candidate;
use Modules\RRHH\Entities\Tag;
use App\Models\User;

use Modules\RRHH\Repositories\CandidateRepository;
use Modules\RRHH\Repositories\UserRepository;

use Datatables;
use Session;

class CandidateController extends Controller
{
    public function __construct(UserRepository $users, CandidateRepository $candidates)
    {
        $this->users = $users;
        $this->candidates = $candidates;
    }

    public function index(Request $request)
    {
        return view('rrhh::admin.candidates.index');
    }

    public function data(Request $request)
    {
        return $this->candidates->getDatatableData('candidate', $request->get('extra_search'));
    }

    public function create(Request $request)
    {
        return view('rrhh::admin.candidates.form');
    }

    public function store(CandidateRequest $request)
    {
        try {
            $candidate = $this->dispatchNow(CreateCandidate::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('rrhh.admin.candidates.show', $candidate->user_id);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.candidates.create')->withInput($request->toArray());
    }

    public function show(User $user)
    {
        $userTags = $user->candidate
            ? $user->candidate
                ->tags()
                ->get()
                ->pluck('name')
            : null;

        return view('rrhh::admin.candidates.form', [
            'user' => $user,
            'userTags' => $userTags,
            'allTAgs' => Tag::orderBy('name')->get()->pluck('name'),
        ]);
    }

    public function update(User $user, CandidateRequest $request)
    {
        try {
            $this->dispatchNow(UpdateCandidate::fromRequest($user, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.candidates.show', $user);
    }

    public function delete(User $user, Request $request)
    {
        try {
            $this->dispatchNow(new DeleteCandidate($user));


            if($request->ajax()) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                Session::flash('notify_success', 'Suppression effectué avec succès');
            }
        } catch (\Exception $e) {
            if($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            } else {
                Session::flash('notify_error', $e->getMessage());
            }
        }

        if($request->ajax()) {
            return response()->json([
                'success' => false
            ], 500);
        }

        return redirect()->route('rrhh.admin.candidates.index');
    }

    public function applications(User $user)
    {
        return Datatables::of($user->candidate->applications)
               ->addColumn('title', function ($item) {
                   return isset($item->offer) ? $item->offer->title : $item->getTypeString();
               })
               ->addColumn('created_at', function ($item) {
                   return $item->created_at;
               })
               ->addColumn('status', function ($item) {
                   return $item->getStatusString();
               })
           ->make(true);
    }

    public function updatetags(User $user, Request $request)
    {
        try {
            $this->dispatchNow(new UpdateCandidateTags($user, json_decode($request->input('tags'))));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('rrhh.admin.candidates.show', $user);
    }

    public function filestore(CreateFileRequest $request)
    {
        return $this->dispatchNow(CreateFile::fromRequest($request));
    }

    public function downloadCV(Candidate $candidate)
    {
        $filename = sprintf('CV_%d_%s_%s.%s',
            $candidate->user->id,
            str_slug($candidate->user->firstname, '-'),
            str_slug($candidate->user->lastname, '-'),
            pathinfo($candidate->resume_file, PATHINFO_EXTENSION)
        );

        return response()->download(storage_path('app/public/candidates/'.$candidate->resume_file), $filename);
    }
}
