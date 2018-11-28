<?php

namespace Modules\RRHH\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\RRHH\Entities\Agence;
use Modules\RRHH\Entities\Content\Category;
use Modules\RRHH\Entities\Content\Content;
use Modules\RRHH\Entities\Content\Typology;
use Modules\RRHH\Repositories\Content\CategoryRepository;
use Modules\RRHH\Repositories\Content\ContentRepository;
use Modules\RRHH\Repositories\OfferRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(ContentRepository $contents, CategoryRepository $categories, OfferRepository $offers)
    {
        $this->contents = $contents;
        $this->categories = $categories;
        $this->offers = $offers;
    }

    public function page($slug, Request $request)
    {
        if (! empty($this->contents->getBySlug($slug)) && 1 == $this->contents->getBySlug($slug)->status) {
            return view('front.static-page', [
                'content' => $this->contents->getBySlug($slug),
            ]);
        } else {
            abort(404);
        }
    }

    public function agencePage($slug)
    {
        $agence = Agence::getBySlug($slug)->first();

        return view('front.agences.page', [
            'coords' => $agence->setGeo(),
            'agence' => $agence,
            'related_offers' => $this->offers->getRandomOffersByAgence($agence->id, 3),
        ]);
    }

    public function recruiterCategory($slug, Request $request)
    {
        $category = Category::whereField('slug', $slug)->first();
        $typology = Typology::byIdentifier('post')->first();

        return view('front.recruiter.category', [
            'category' => $category,
            'contents' => $category ? $category->contents()->where('status', 1)->get() : null,
            'categories' => $this->categories->findWhere([
                'status' => 1,
                'typology_id' => $typology->id,
            ])->all(),
        ]);
    }

    public function recruiterPage($category, $slug)
    {
        $content = Content::getBySlug($slug)->first();
        $typology = Typology::byIdentifier('post')->first();

        $othersContents = Content::whereCategory($content->getCategoriesIds())
            ->with('fields')
            ->where('typology_id', $typology->id)
            ->where('status', 1)
            ->where('id', '<>', $content->id)
            ->get();

        return view('front.recruiter.page', [
            'content' => $content,
            'categories' => $this->categories->findWhere([
                'status' => 1,
                'typology_id' => $typology->id,
            ])->all(),
            'othersContents' => $othersContents,
        ]);
    }

    public function recruiterPageEntreprise($slug)
    {
        $content = Content::getBySlug($slug)->first();
        $typology = Typology::byIdentifier('entreprise_content')->first();

        return view('front.recruiter.entreprise', [
            'content' => $content,
            'category' => 'Entreprise',
        ]);
    }

    public function candidateCategory($slug, Request $request)
    {
        $category = Category::whereField('slug', $slug)->first();
        $typology = Typology::byIdentifier('candidat_content')->first();

        return view('front.candidate.category', [
            'category' => $category,
            'contents' => $category ? $category->contents()->where('status', 1)->orderBy('id')->get() : null,
            'categories' => $this->categories->findWhere([
                'status' => 1,
                'typology_id' => $typology->id,
            ])->all(),
        ]);
    }

    public function candidatePage($slug)
    {
        return view('front.candidate.page', [
            'content' => Content::getBySlug($slug)->first(),
        ]);
    }
}
