<?php

Route::get('sitemap.xml', 'Modules\BWO\Http\Controllers\SitemapController@sitemap')->name('sitemap');
Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [
      'web',
      'localeSessionRedirect',
      'localizationRedirect',
      'localeViewPath',
      'localize'
  ],
  'namespace' => 'Modules\BWO\Http\Controllers'
], function() {

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    /*
    |--------------------------------------------------------------------------
    | LINKEDIN CALLBACK
    |--------------------------------------------------------------------------
    */
    Route::get('/linkedin/callback', 'LinkedinController@callback')->name('linkedin.callback');

    /*
    |--------------------------------------------------------------------------
    | OFFERS
    |--------------------------------------------------------------------------
    */
    Route::get('/emplois', ['as' => 'search', 'uses' => 'SearchController@index']);

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */
    //Route::get('/{slug}.html', ['as' => 'page', 'uses' => 'Front\PageController@page']);
    //Route::get('/recruteur/{slug}', ['as' => 'recruiter.category', 'uses' => 'Front\PageController@recruiterCategory']);
    //Route::get('/recruteur/{category}/{slug}.html', ['as' => 'recruiter.page', 'uses' => 'Front\PageController@recruiterPage']);
    //Route::get('/entreprise/{slug}.html', ['as' => 'entreprise.page', 'uses' => 'Front\PageController@recruiterPageEntreprise']);

    //Route::get('/candidat/{slug}.html', ['as' => 'candidate.page', 'uses' => 'Front\PageController@candidatePage']);
    //Route::get('/candidat/{slug}', ['as' => 'candidate.category', 'uses' => 'Front\PageController@candidateCategory']);

    //Route::get('/agences/{slug}', ['as' => 'agences.page', 'uses' => 'Front\PageController@agencePage']);
    Route::get('/offers.xml', ['as' => 'offers.xml', 'uses' => 'Front\OfferXMLController@index']);

    /*
    |--------------------------------------------------------------------------
    | CONTACT
    |--------------------------------------------------------------------------
    */
    Route::get('/contact', ['as' => 'contact.index', 'uses' => 'ContactController@index']);
    Route::post('/contact', ['as' => 'contact.send', 'uses' => 'ContactController@send']);

    /*
    |--------------------------------------------------------------------------
    | OFFER
    |--------------------------------------------------------------------------
    */
    //Route::get('/offer/{offer}', ['as' => 'offer.show', 'uses' => 'OfferController@index']);
    Route::get('/emplois/{job_1}/{offer?}', ['as' => 'offer.show', 'uses' => 'OfferController@index']);
    Route::post('/offers/application/{offer}/create', ['as' => 'offer.applications.create', 'uses' => 'OfferApplicationController@create']);
    Route::post('/candidate/store', ['as' => 'candidate.store', 'uses' => 'CandidateController@store']);
    Route::post('/candidate/login', ['as' => 'candidate.login', 'uses' => 'CandidateController@login']);
    Route::post('/candidate/addcv', ['as' => 'candidate.addcv', 'uses' => 'CandidateController@addcv']);
    Route::post('/candidate/addtag', ['as' => 'candidate.addtag', 'uses' => 'CandidateController@addtag']);


    /*
    |--------------------------------------------------------------------------
    | SPONTANIOUS CANDIDATES
    |--------------------------------------------------------------------------
    */
    Route::get('/candidature-spontanee', ['as' => 'spontanious.form', 'uses' => 'SpontaniousController@index']);
    Route::post('/candidature-spontanee', ['as' => 'spontanious.store', 'uses' => 'SpontaniousController@store']);
    Route::get('/candidature-spontanee/success', ['as' => 'spontanious.success', 'uses' => 'SpontaniousController@success']);


    /*
    |--------------------------------------------------------------------------
    | ARCHITECT FRONT-END
    |--------------------------------------------------------------------------
    */

    Route::get('/countries/list', 'CountriesController@list')->name('countries.list');
    Route::get('/preview/{id}', 'ContentController@preview')->name('preview');

    Route::get(LaravelLocalization::transRoute('routes.category.index'), 'CategoryController@index')->name('blog.category.index');
    Route::get(LaravelLocalization::transRoute('routes.tag.index'), 'TagController@index')->name('blog.tag.index');

    Route::get('/not-found', 'ContentController@languageNotFound')->name('language-not-found');

    //FIXME pass this routes to ContentController
    //Route::get('/', 'BWOController@index')->name('home');
    //Route::get('/offers', 'BWOController@offers')->name('offers');
    //Route::get('/offer', 'BWOController@offer')->name('offer');
    Route::get('/blog-old', 'BWOController@blog')->name('blog');
    Route::get('/post-old', 'BWOController@post')->name('post');
    Route::get('/candidate', 'BWOController@candidate')->name('candidate');
    Route::get('/candidate/information', 'BWOController@candidateForm')->name('candidate.form');

    Route::get('/{slug}','ContentController@show')
      ->where('slug', '([A-Za-z0-9\-\/]+)')
      ->name('content.show');

    // Localization to JS
    Route::get('js/lang-{locale}.js', 'LocalizationController@index')->name('messages');
    Route::get('js/localization-{locale}.js', 'LocalizationController@localization')->name('localization.js');

});
