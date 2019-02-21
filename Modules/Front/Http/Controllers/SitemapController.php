<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReserveRequest;
use Illuminate\Support\Facades\DB;

use Modules\Architect\Entities\Language;
use Modules\Architect\Entities\Content;
use Modules\Architect\Repositories\ContentRepository;
use LaravelLocalization;

class SitemapController extends Controller
{

		public function __construct(ContentRepository $contents)
		{
      $this->contents = $contents;
		}

		public function sitemap()
		{

			$languages = LaravelLocalization::getSupportedLocales();
			$languagesByIso = Language::getByIso();

      $contents = $this->contents->findWhere(['is_page'=>1,'status'=>1]);
			$urls = [];
			//dd($contents->toArray());

			foreach($contents as $content){
				$contentUrls = [];

				foreach($content->urls as $url){
					$contentUrls[$languagesByIso[$url->language_id]] = [
						"url" => $url->url,
						"priority"=> 1
					];
				}

				array_push($urls,$contentUrls);
			}

			$contents = Content::whereHas('typology', function($query) {
			    return $query->where('has_slug', 1);
			})->get();

			foreach($contents as $content){
				$contentUrls = [];

				foreach($content->urls as $url){
					$contentUrls[$languagesByIso[$url->language_id]] = [
						"url" => $url->url,
						"priority"=> 0.8
					];
				}

				array_push($urls,$contentUrls);
			}

			return response()->view('front::sitemap', [
	      "urls" => $urls,
				"languages" => $languages
	  	])->header('Content-Type', 'text/xml');

		}

}
