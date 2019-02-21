<?php

namespace Modules\Front\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\Extranet\Http\Requests\Candidate\CandidateCVRequest;
use Modules\Extranet\Http\Requests\Candidate\CandidateLetterRequest;
use Modules\Extranet\Jobs\Candidate\UploadCVCandidate;
use Modules\Extranet\Jobs\Candidate\UploadLetterCandidate;
use Modules\Extranet\Repositories\OfferRepository;
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
        return view('front::candidate.document', [
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            'active_hex' => 'documents',
        ]);
    }

    public function storecv(CandidateCVRequest $request)
    {
        try {
            $path = $this->dispatchNow(UploadCVCandidate::fromRequest($request));
            return redirect()->route('candidate.document')->with('success','Votre CV a été sauvegardée');
        } catch (\Exception $e) {
            return redirect()->route('candidate.document')->with('error',$e->getMessage());
        }

        return redirect()->route('candidate.document');
    }

    public function storeletter(CandidateLetterRequest $request)
    {
        try {
            $path = $this->dispatchNow(UploadLetterCandidate::fromRequest($request));
            Session::flash('notify_success', 'Votre lettre de motivation a été sauvegardée');

            return redirect()->route('candidate.document')->with('success','Votre lettre de motivation a été sauvegardée');

        } catch (\Exception $e) {
            return redirect()->route('candidate.document')->with('error',$e->getMessage());
        }

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
