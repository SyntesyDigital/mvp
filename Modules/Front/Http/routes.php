<?php

Route::get('sitemap.xml', 'Modules\Front\Http\Controllers\SitemapController@sitemap')->name('sitemap');
Route::group([
  // 'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [
      'web',
      // 'localeSessionRedirect',
      // 'localizationRedirect',
      // 'localeViewPath',
      // 'localize'
  ],
  'namespace' => 'Modules\Front\Http\Controllers'
], function() {

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    //Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

    /*
    |--------------------------------------------------------------------------
    | LINKEDIN
    |--------------------------------------------------------------------------
    */
    Route::get('/linkedin/callback', 'LinkedinController@callback')->name('linkedin.callback');
    Route::post('/linkedin/login/save', 'LinkedinController@create')->name('linkedin.create');
    Route::get('/linkedin/login', 'LinkedinController@login')->name('linkedin.login');



    /*
    |--------------------------------------------------------------------------
    | OFFERS
    |--------------------------------------------------------------------------
    */
    Route::get('/offres-d-emploi', ['as' => 'search', 'uses' => 'SearchController@index']);

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */
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
    | CANDIDATE
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'candidate', 'as' => 'candidate', 'middleware' => ['role:candidate']], function () {
        Route::get('/', ['as' => '.index', 'uses' => 'Candidate\HomeController@index']);
        Route::get('/profile', ['as' => '.profile', 'uses' => 'Candidate\CandidateController@index']);
        Route::get('/alert', ['as' => '.alert', 'uses' => 'Candidate\AlertController@index']);
        Route::get('/application', ['as' => '.application', 'uses' => 'Candidate\ApplicationController@index']);
        Route::get('/contact', ['as' => '.contact', 'uses' => 'Candidate\ContactController@index']);
        Route::get('/document', ['as' => '.document', 'uses' => 'Candidate\DocumentController@index']);
        Route::post('/profile/edit', ['as' => '.edit.profile', 'uses' => 'Candidate\CandidateController@store']);
        Route::post('/profile/contact', ['as' => '.contact.send', 'uses' => 'Candidate\ContactController@send']);
        Route::post('/profile/alerts', ['as' => '.alert.send', 'uses' => 'Candidate\AlertController@store']);
        Route::get('/profile/applications/data', ['as' => '.applications.data', 'uses' => 'Candidate\ApplicationController@data']);
        Route::post('/candidate/storecv', ['as' => '.profile.storecv', 'uses' => 'Candidate\DocumentController@storecv']);
        Route::post('/candidate/storeletter', ['as' => '.profile.storeletter', 'uses' => 'Candidate\DocumentController@storeletter']);
        Route::get('/candidate/downloadcv', ['as' => '.profile.downloadcv', 'uses' => 'Candidate\DocumentController@downloadCV']);
        Route::get('/candidate/downloadletter', ['as' => '.profile.downloadletter', 'uses' => 'Candidate\DocumentController@downloadLetter']);
    });

    /*
    |--------------------------------------------------------------------------
    | OFFER
    |--------------------------------------------------------------------------
    */
    Route::get('/offres-d-emploi/{job_1}/{offer?}', ['as' => 'offer.show', 'uses' => 'OfferController@index']);
    Route::get('/offers/{offer}/preview', 'OfferController@preview')->name('offers.preview');
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
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'customer', 'as' => 'customer', 'middleware' => ['role:customer']], function () {
      Route::get('/entreprises', ['as' => '.index', 'uses' => 'Customer\HomeController@index']);
      Route::get('/entreprises/profile', ['as' => '.profile', 'uses' => 'Customer\CustomerController@index']);
      Route::post('/entreprises/edit', ['as' => '.edit.profile', 'uses' => 'Customer\CustomerController@store']);
      Route::get('/entreprises/documents', ['as' => '.document', 'uses' => 'Customer\DocumentController@index']);

    });

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
    //Route::get('/candidate', 'FrontController@candidate')->name('candidate');
    Route::get('/candidate-old/information', 'FrontController@candidateForm')->name('candidate.form');

    Route::get('/{slug}','ContentController@show')
      ->where('slug', '([A-Za-z0-9\-\/]+)')
      ->name('content.show');

    // Localization to JS
    Route::get('js/lang-{locale}.js', 'LocalizationController@index')->name('messages');
    Route::get('js/localization-{locale}.js', 'LocalizationController@localization')->name('localization.js');



});
