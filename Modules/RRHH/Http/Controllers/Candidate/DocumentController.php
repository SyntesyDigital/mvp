<?php

namespace Modules\RRHH\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Candidate\CandidateCVRequest;
use Modules\RRHH\Http\Requests\Candidate\CandidateLetterRequest;
use Modules\RRHH\Jobs\Candidate\UploadCVCandidate;
use Modules\RRHH\Jobs\Candidate\UploadLetterCandidate;
use Modules\RRHH\Repositories\OfferRepository;
use Auth;
use Illuminate\Http\Request;
use Session;

class DocumentController extends Controller
{
    public function __construct(
        OfferRepository $offers
    ) {
        $this->offers = $offers;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('candidate.document', [
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            'active_hex' => 'document',
        ]);
    }

    public function storecv(CandidateCVRequest $request)
    {
        try {
            $path = $this->dispatchNow(UploadCVCandidate::fromRequest($request));
            Session::flash('notify_success', 'Votre CV a été sauvegardée');
        } catch (\Exception $e) {
            Session::flash('notify_error', 'Une erreur s\'est produite lors de la sauvegarde du fichier');
        }

        return redirect()->route('candidate.profile');
    }

    public function storeletter(CandidateLetterRequest $request)
    {
        try {
            $path = $this->dispatchNow(UploadLetterCandidate::fromRequest($request));
            Session::flash('notify_success', 'Votre lettre de motivation a été sauvegardée');
        } catch (\Exception $e) {
            Session::flash('notify_error', 'Une erreur s\'est produite lors de la sauvegarde du fichier');
        }

        return redirect()->route('candidate.profile');
    }

    public function downloadCV(Request $request)
    {
        $filename = sprintf('CV_%d_%s_%s.%s',
            Auth::user()->candidate->user->id,
            str_slug(Auth::user()->candidate->user->firstname, '-'),
            str_slug(Auth::user()->candidate->user->lastname, '-'),
            pathinfo(Auth::user()->candidate->resume_file, PATHINFO_EXTENSION)
        );

        return response()->download(storage_path('app/public/candidates/'.Auth::user()->candidate->resume_file), $filename);
    }

    public function downloadLetter(Request $request)
    {
        $filename = sprintf('Lettre_recommandation_%d_%s_%s.%s',
            Auth::user()->candidate->user->id,
            str_slug(Auth::user()->candidate->user->firstname, '-'),
            str_slug(Auth::user()->candidate->user->lastname, '-'),
            pathinfo(Auth::user()->candidate->recommendation_letter, PATHINFO_EXTENSION)
        );

        return response()->download(storage_path('app/public/candidates/'.Auth::user()->candidate->recommendation_letter), $filename);
    }
}
