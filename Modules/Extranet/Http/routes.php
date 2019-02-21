<?php

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::group([
  'middleware' => ['web', 'auth','role:admin|recruiter', 'DetectUserLocale'],
  'prefix' => 'architect',
  'namespace' => 'Modules\Extranet\Http\Controllers'
], function() {

    // Tags
    Route::get('/offer-tags', 'Admin\TagController@index')->name('extranet.admin.tags.index');
    Route::get('/offer-tags/data', 'Admin\TagController@data')->name('extranet.admin.tags.data');
    Route::get('/offer-tags/create', 'Admin\TagController@create')->name('extranet.admin.tags.create');
    Route::post('/offer-tags/store', 'Admin\TagController@store')->name('extranet.admin.tags.store');
    Route::get('/offer-tags/{tag?}', 'Admin\TagController@show')->name('extranet.admin.tags.show');
    Route::put('/offer-tags/{tag?}/update', 'Admin\TagController@update')->name('extranet.admin.tags.update');
    Route::delete('/offer-tags/{tag?}/delete', 'Admin\TagController@delete')->name('extranet.admin.tags.delete');

    // Candidates
    Route::get('/candidates', 'Admin\Users\CandidateController@index')->name('extranet.admin.candidates.index');
    Route::get('/candidates/create', 'Admin\Users\CandidateController@create')->name('extranet.admin.candidates.create');
    Route::post('/candidates/store', 'Admin\Users\CandidateController@store')->name('extranet.admin.candidates.store');
    Route::get('/candidates/data', 'Admin\Users\CandidateController@data')->name('extranet.admin.candidates.data');
    Route::get('/candidates/applications/{user?}/data', 'Admin\Users\CandidateController@applications')->name('extranet.admin.candidates.applications.data');
    Route::get('/candidates/{user?}', 'Admin\Users\CandidateController@show')->name('extranet.admin.candidates.show');
    Route::put('/candidates/{user?}/update', 'Admin\Users\CandidateController@update')->name('extranet.admin.candidates.update');
    Route::delete('/candidates/{user?}/delete','Admin\Users\CandidateController@delete')->name('extranet.admin.candidates.delete');
    Route::post('/candidates/{user?}/updatetags', 'Admin\Users\CandidateController@updatetags')->name('extranet.admin.candidates.updatetags');
    Route::post('/candidates/filestore', 'Admin\Users\CandidateController@filestore')->name('extranet.admin.candidates.filestore');
    Route::get('/candidates/{candidate?}/downloadcv', 'Admin\Users\CandidateController@downloadCV')->name('extranet.admin.candidates.downloadcv');



    // Offers
    Route::get('/offers', 'Admin\Offers\OfferController@index')->name('extranet.admin.offers.index');
    Route::get('/offers/data', 'Admin\Offers\OfferController@data')->name('extranet.admin.offers.index.data');
    Route::get('/offers/data/recipients', 'Admin\Offers\OfferController@recipients')->name('extranet.admin.offers.index.data.recipients');
    Route::get('/offers/create', 'Admin\Offers\OfferController@create')->name('extranet.admin.offers.create');
    Route::post('/offers/store', 'Admin\Offers\OfferController@store')->name('extranet.admin.offers.store');
    Route::get('/offers/{offer?}', 'Admin\Offers\OfferController@show')->name('extranet.admin.offers.show');
    Route::put('/offers/{offer?}/update', 'Admin\Offers\OfferController@update')->name('extranet.admin.offers.update');
    Route::delete('/offers/{offer?}/delete', 'Admin\Offers\OfferController@delete')->name('extranet.admin.offers.delete');
    Route::get('/offers/{offer?}/publish/facebook', 'Admin\Offers\OfferController@publishFacebook')->name('extranet.admin.offer.applications.publish.facebook');

    // Applications
    Route::get('/applications','Admin\Offers\ApplicationController@index')->name('extranet.admin.applications.index');
    Route::get('/applications/spontaneous', 'Admin\Offers\ApplicationController@spontaneous')->name('extranet.admin.applications.spontaneous');
    Route::get('/applications/data', 'Admin\Offers\ApplicationController@data')->name('extranet.admin.applications.data');
    Route::get('/applications/spontaneous/data', 'Admin\Offers\ApplicationController@spontaneousData')->name('extranet.admin.applications.spontaneous.data');
    Route::post('/applications/spontaneous/update/status', 'Admin\Offers\ApplicationController@updateStatus')->name('extranet.admin.applications.spontaneous.update.status');
    Route::delete('/applications/{application?}/delete', 'Admin\Offers\ApplicationController@delete')->name('extranet.admin.applications.delete');

    // Offer Applications
    Route::get('/offer/{offer?}/applications', 'Admin\Offers\OfferApplicationController@show')->name('extranet.admin.offer.applications.show');
    Route::post('/offers/application/{application?}/update', 'Admin\Offers\OfferApplicationController@update')->name('extranet.admin.applications.update');
    Route::post('/offers/application/{application?}/move', 'Admin\Offers\OfferApplicationController@move')->name('extranet.admin.applications.move');

    // Agences
    Route::get('/agences', 'Admin\AgenceController@index')->name('extranet.admin.agences.index');
    Route::get('/agences/create', 'Admin\AgenceController@create')->name('extranet.admin.agences.create');
    Route::post('/agences/store', 'Admin\AgenceController@store')->name('extranet.admin.agences.store');
    Route::get('/agences/data', 'Admin\AgenceController@data')->name('extranet.admin.agences.data');
    Route::get('/agences/{agence?}', 'Admin\AgenceController@show')->name('extranet.admin.agences.show');
    Route::put('/agences/{agence?}/update', 'Admin\AgenceController@update')->name('extranet.admin.agences.update');
    Route::delete('/agences/{agence?}/delete', 'Admin\AgenceController@delete')->name('extranet.admin.agences.delete');
    Route::post('/agences/filestore', 'Admin\AgenceController@filestore')->name('extranet.admin.agences.filestore');
    Route::get('/agences/{agence?}/downloadcv', 'Admin\AgenceController@downloadCV')->name('extranet.admin.agences.downloadcv');

    // Customers
    Route::get('/customers', 'Admin\AdminCustomerController@index')->name('extranet.admin.customers.index');
    Route::get('/customers/create', 'Admin\AdminCustomerController@create')->name('extranet.admin.customers.create');
    Route::post('/customers/store', 'Admin\AdminCustomerController@store')->name('extranet.admin.customers.store');
    Route::get('/customers/data', 'Admin\AdminCustomerController@data')->name('extranet.admin.customers.data');
    Route::get('/customers/{customer?}', 'Admin\AdminCustomerController@show')->name('extranet.admin.customers.show');
    Route::put('/customers/{customer?}/update', 'Admin\AdminCustomerController@update')->name('extranet.admin.customers.update');
    Route::delete('/customers/{customer?}/delete', 'Admin\AdminCustomerController@delete')->name('extranet.admin.customers.delete');

    Route::get('/customers/{customer?}/users', 'Admin\AdminCustomerUserController@data')->name('extranet.admin.customers.users.data');
    Route::post('/customers/{customer?}/users', 'Admin\AdminCustomerUserController@create')->name('extranet.admin.customers.users.create');
    Route::put('/customers/{customer?}/users/{user?}/update', 'Admin\AdminCustomerUserController@update')->name('extranet.admin.customers.users.update');
    Route::delete('/customers/{customer?}/users/{user?}/delete', 'Admin\AdminCustomerUserController@delete')->name('extranet.admin.customers.users.delete');


    // Lists
    Route::get('/sitelists', 'Admin\SiteListController@index')->name('extranet.admin.sitelists.index');
    Route::get('/sitelists/create', 'Admin\SiteListController@create')->name('extranet.admin.sitelists.create');
    Route::post('/sitelists/store', 'Admin\SiteListController@store')->name('extranet.admin.sitelists.store');
    Route::get('/sitelists/{sitelist?}', 'Admin\SiteListController@show')->name('extranet.admin.sitelists.show');
    Route::put('/sitelists/{sitelist?}/update', 'Admin\SiteListController@update')->name('extranet.admin.sitelists.update');
    Route::delete('/sitelists/{sitelist?}/delete', 'Admin\SiteListController@delete')->name('extranet.admin.sitelists.delete');


    // File List
    Route::get('/filelist', ['as' => 'extranet.tools.filelist.index', 'uses' => 'Admin\Tools\FileListController@index']);
    Route::put('/tools/filelist/{sitelist?}/update', ['as' => 'extranet.tools.filelist.update', 'uses' => 'Admin\Tools\FileListController@update']);
    Route::post('/tools/filelist/store', ['as' => 'extranet.tools.filelist.store', 'uses' => 'Admin\Tools\FileListController@store']);
    Route::post('/tools/filelist/delete', ['as' => 'extranet.tools.filelist.delete', 'uses' => 'Admin\Tools\FileListController@delete']);
    Route::post('/tools/filelist/sort', ['as' => 'extranet.tools.filelist.delete', 'uses' => 'Admin\Tools\FileListController@sort']);

    // Mass Mail Sending
    Route::get('/massmail', 'Admin\MassmailController@index')->name('extranet.admin.massmail');
    Route::post('/massmail/send', 'Admin\MassmailController@send')->name('extranet.admin.massmail.send');

    // Templates Emails
    Route::get('/emails-templates', 'Admin\EmailTemplateController@index')->name('extranet.admin.emailstemplates.index');
    Route::get('/emails-templates/create', 'Admin\EmailTemplateController@create')->name('extranet.admin.emailstemplates.create');
    Route::post('/emails-templates/store', 'Admin\EmailTemplateController@store')->name('extranet.admin.emailstemplates.store');
    Route::get('/emails-templates/{template?}', 'Admin\EmailTemplateController@show')->name('extranet.admin.emailstemplates.show');
    Route::put('/emails-templates/{template?}/update', 'Admin\EmailTemplateController@update')->name('extranet.admin.emailstemplates.update');
    Route::delete('/emails-templates/{template?}/delete', 'Admin\EmailTemplateController@delete')->name('extranet.admin.emailstemplates.delete');

});

Route::group([
  'middleware' => ['web', 'auth','role:admin|customer', 'DetectUserLocale'],
  'prefix' => 'architect',
  'namespace' => 'Modules\Extranet\Http\Controllers'
], function() {

  Route::get('/customers/{customer?}/documents', 'Admin\AdminCustomerDocumentsController@data')->name('extranet.admin.customers.documents.data');
  Route::post('/customers/{customer?}/documents', 'Admin\AdminCustomerDocumentsController@upload')->name('extranet.admin.customers.documents.upload');
  Route::delete('/customers/{customer?}/documents/delete', 'Admin\AdminCustomerDocumentsController@delete')->name('extranet.admin.customers.documents.delete');

});

Route::group([
  'middleware' => ['web', 'auth','role:admin|candidate', 'DetectUserLocale'],
  'prefix' => 'architect',
  'namespace' => 'Modules\Extranet\Http\Controllers'
], function() {

  Route::get('/candidates/{candidate}/documents', 'Admin\AdminCandidateDocumentsController@data')->name('extranet.admin.candidates.documents.data');
  Route::post('/candidates/{candidate}/documents', 'Admin\AdminCandidateDocumentsController@upload')->name('extranet.admin.candidates.documents.upload');
  Route::delete('/candidates/{candidate}/documents/delete', 'Admin\AdminCandidateDocumentsController@delete')->name('extranet.admin.candidates.documents.delete');

});
