<?php

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::group([
  'middleware' => ['web', 'auth','role:admin|recruiter', 'DetectUserLocale'],
  'prefix' => 'architect',
  'namespace' => 'Modules\RRHH\Http\Controllers'
], function() {

    // Tags
    Route::get('/offer-tags', 'Admin\TagController@index')->name('rrhh.admin.tags.index');
    Route::get('/offer-tags/data', 'Admin\TagController@data')->name('rrhh.admin.tags.data');
    Route::get('/offer-tags/create', 'Admin\TagController@create')->name('rrhh.admin.tags.create');
    Route::post('/offer-tags/store', 'Admin\TagController@store')->name('rrhh.admin.tags.store');
    Route::get('/offer-tags/{tag?}', 'Admin\TagController@show')->name('rrhh.admin.tags.show');
    Route::put('/offer-tags/{tag?}/update', 'Admin\TagController@update')->name('rrhh.admin.tags.update');
    Route::delete('/offer-tags/{tag?}/delete', 'Admin\TagController@delete')->name('rrhh.admin.tags.delete');

    // Candidates
    Route::get('/candidates', 'Admin\Users\CandidateController@index')->name('rrhh.admin.candidates.index');
    Route::get('/candidates/create', 'Admin\Users\CandidateController@create')->name('rrhh.admin.candidates.create');
    Route::post('/candidates/store', 'Admin\Users\CandidateController@store')->name('rrhh.admin.candidates.store');
    Route::get('/candidates/data', 'Admin\Users\CandidateController@data')->name('rrhh.admin.candidates.data');
    Route::get('/candidates/applications/{user?}/data', 'Admin\Users\CandidateController@applications')->name('rrhh.admin.candidates.applications.data');
    Route::get('/candidates/{user?}', 'Admin\Users\CandidateController@show')->name('rrhh.admin.candidates.show');
    Route::put('/candidates/{user?}/update', 'Admin\Users\CandidateController@update')->name('rrhh.admin.candidates.update');
    Route::delete('/candidates/{user?}/delete','Admin\Users\CandidateController@delete')->name('rrhh.admin.candidates.delete');
    Route::post('/candidates/{user?}/updatetags', 'Admin\Users\CandidateController@updatetags')->name('rrhh.admin.candidates.updatetags');
    Route::post('/candidates/filestore', 'Admin\Users\CandidateController@filestore')->name('rrhh.admin.candidates.filestore');
    Route::get('/candidates/{candidate?}/downloadcv', 'Admin\Users\CandidateController@downloadCV')->name('rrhh.admin.candidates.downloadcv');

    // Offers
    Route::get('/offers', 'Admin\Offers\OfferController@index')->name('rrhh.admin.offers.index');
    Route::get('/offers/data', 'Admin\Offers\OfferController@data')->name('rrhh.admin.offers.index.data');
    Route::get('/offers/data/recipients', 'Admin\Offers\OfferController@recipients')->name('rrhh.admin.offers.index.data.recipients');
    Route::get('/offers/create', 'Admin\Offers\OfferController@create')->name('rrhh.admin.offers.create');
    Route::post('/offers/store', 'Admin\Offers\OfferController@store')->name('rrhh.admin.offers.store');
    Route::get('/offers/{offer?}', 'Admin\Offers\OfferController@show')->name('rrhh.admin.offers.show');
    Route::put('/offers/{offer?}/update', 'Admin\Offers\OfferController@update')->name('rrhh.admin.offers.update');
    Route::delete('/offers/{offer?}/delete', 'Admin\Offers\OfferController@delete')->name('rrhh.admin.offers.delete');

    // Applications
    Route::get('/applications','Admin\Offers\ApplicationController@index')->name('rrhh.admin.applications.index');
    Route::get('/applications/spontaneous', 'Admin\Offers\ApplicationController@spontaneous')->name('rrhh.admin.applications.spontaneous');
    Route::get('/applications/data', 'Admin\Offers\ApplicationController@data')->name('rrhh.admin.applications.data');
    Route::get('/applications/spontaneous/data', 'Admin\Offers\ApplicationController@spontaneousData')->name('rrhh.admin.applications.spontaneous.data');
    Route::post('/applications/spontaneous/update/status', 'Admin\Offers\ApplicationController@updateStatus')->name('rrhh.admin.applications.spontaneous.update.status');
    Route::delete('/applications/{application?}/delete', 'Admin\Offers\ApplicationController@delete')->name('rrhh.admin.applications.delete');

    // Offer Applications
    Route::get('/offer/{offer?}/applications', 'Admin\Offers\OfferApplicationController@show')->name('rrhh.admin.offer.applications.show');
    Route::post('/offers/application/{application?}/update', 'Admin\Offers\OfferApplicationController@update')->name('rrhh.admin.applications.update');
    Route::post('/offers/application/{application?}/move', 'Admin\Offers\OfferApplicationController@move')->name('rrhh.admin.applications.move');

    // Agences
    Route::get('/agences', 'Admin\AgenceController@index')->name('rrhh.admin.agences.index');
    Route::get('/agences/create', 'Admin\AgenceController@create')->name('rrhh.admin.agences.create');
    Route::post('/agences/store', 'Admin\AgenceController@store')->name('rrhh.admin.agences.store');
    Route::get('/agences/data', 'Admin\AgenceController@data')->name('rrhh.admin.agences.data');
    Route::get('/agences/{agence?}', 'Admin\AgenceController@show')->name('rrhh.admin.agences.show');
    Route::put('/agences/{agence?}/update', 'Admin\AgenceController@update')->name('rrhh.admin.agences.update');
    Route::delete('/agences/{agence?}/delete', 'Admin\AgenceController@delete')->name('rrhh.admin.agences.delete');
    Route::post('/agences/filestore', 'Admin\AgenceController@filestore')->name('rrhh.admin.agences.filestore');
    Route::get('/agences/{agence?}/downloadcv', 'Admin\AgenceController@downloadCV')->name('rrhh.admin.agences.downloadcv');

    // Customers
    Route::get('/customers', 'Admin\AdminCustomerController@index')->name('rrhh.admin.customers.index');
    Route::get('/customers/create', 'Admin\AdminCustomerController@create')->name('rrhh.admin.customers.create');
    Route::post('/customers/store', 'Admin\AdminCustomerController@store')->name('rrhh.admin.customers.store');
    Route::get('/customers/data', 'Admin\AdminCustomerController@data')->name('rrhh.admin.customers.data');
    Route::get('/customers/{customer?}', 'Admin\AdminCustomerController@show')->name('rrhh.admin.customers.show');
    Route::put('/customers/{customer?}/update', 'Admin\AdminCustomerController@update')->name('rrhh.admin.customers.update');
    Route::delete('/customers/{customer?}/delete', 'Admin\AdminCustomerController@delete')->name('rrhh.admin.customers.delete');

    Route::get('/customers/{customer?}/users', 'Admin\AdminCustomerUserController@data')->name('rrhh.admin.customers.users.data');
    Route::post('/customers/{customer?}/users', 'Admin\AdminCustomerUserController@create')->name('rrhh.admin.customers.users.create');
    Route::put('/customers/{customer?}/users/{user?}/update', 'Admin\AdminCustomerUserController@update')->name('rrhh.admin.customers.users.update');
    Route::delete('/customers/{customer?}/users/{user?}/delete', 'Admin\AdminCustomerUserController@delete')->name('rrhh.admin.customers.users.delete');


    // Lists
    Route::get('/sitelists', 'Admin\SiteListController@index')->name('rrhh.admin.sitelists.index');
    Route::get('/sitelists/create', 'Admin\SiteListController@create')->name('rrhh.admin.sitelists.create');
    Route::post('/sitelists/store', 'Admin\SiteListController@store')->name('rrhh.admin.sitelists.store');
    Route::get('/sitelists/{sitelist?}', 'Admin\SiteListController@show')->name('rrhh.admin.sitelists.show');
    Route::put('/sitelists/{sitelist?}/update', 'Admin\SiteListController@update')->name('rrhh.admin.sitelists.update');
    Route::delete('/sitelists/{sitelist?}/delete', 'Admin\SiteListController@delete')->name('rrhh.admin.sitelists.delete');


    // File List
    // Route::get('/filelist', ['as' => '.tools.filelist.index', 'uses' => 'Admin\Tools\FileListController@index']);
    // Route::put('/tools/filelist/{sitelist?}/update', ['as' => '.tools.filelist.update', 'uses' => 'Admin\Tools\FileListController@update']);
    // Route::post('/tools/filelist/store', ['as' => '.tools.filelist.store', 'uses' => 'Admin\Tools\FileListController@store']);
    // Route::post('/tools/filelist/delete', ['as' => '.tools.filelist.delete', 'uses' => 'Admin\Tools\FileListController@delete']);
    // Route::post('/tools/filelist/sort', ['as' => '.tools.filelist.delete', 'uses' => 'Admin\Tools\FileListController@sort']);

    // Mass Mail Sending
    Route::get('/massmail', 'Admin\MassmailController@index')->name('rrhh.admin.massmail');
    Route::post('/massmail/send', 'Admin\MassmailController@send')->name('rrhh.admin.massmail.send');

    // Templates Emails
    Route::get('/emails-templates', 'Admin\EmailTemplateController@index')->name('rrhh.admin.emailstemplates.index');
    Route::get('/emails-templates/create', 'Admin\EmailTemplateController@create')->name('rrhh.admin.emailstemplates.create');
    Route::post('/emails-templates/store', 'Admin\EmailTemplateController@store')->name('rrhh.admin.emailstemplates.store');
    Route::get('/emails-templates/{template?}', 'Admin\EmailTemplateController@show')->name('rrhh.admin.emailstemplates.show');
    Route::put('/emails-templates/{template?}/update', 'Admin\EmailTemplateController@update')->name('rrhh.admin.emailstemplates.update');
    Route::delete('/emails-templates/{template?}/delete', 'Admin\EmailTemplateController@delete')->name('rrhh.admin.emailstemplates.delete');

});

Route::group([
  'middleware' => ['web', 'auth','role:admin|customer', 'DetectUserLocale'],
  'prefix' => 'architect',
  'namespace' => 'Modules\RRHH\Http\Controllers'
], function() {

  Route::get('/customers/{customer?}/documents', 'Admin\AdminCustomerDocumentsController@data')->name('rrhh.admin.customers.documents.data');
  Route::post('/customers/{customer?}/documents', 'Admin\AdminCustomerDocumentsController@upload')->name('rrhh.admin.customers.documents.upload');
  Route::delete('/customers/{customer?}/documents/delete', 'Admin\AdminCustomerDocumentsController@delete')->name('rrhh.admin.customers.documents.delete');

});
