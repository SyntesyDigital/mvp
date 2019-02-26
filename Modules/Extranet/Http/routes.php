<?php

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::group([
  'middleware' => ['web', 'auth','role:admin', 'DetectUserLocale'],
  'prefix' => 'architect',
  'namespace' => 'Modules\Extranet\Http\Controllers'
], function() {

    // Extranet
    Route::get('/extranet', 'ExtranetController@index')->name('extranet.extranet.index');
    Route::get('/extranet/create', 'ExtranetController@create')->name('extranet.extranet.create');

    // Models
    Route::get('/models', 'ModelController@index')->name('extranet.models.index');
    Route::get('/models/create/{class}', 'ModelController@create')->name('extranet.models.create');
    Route::get('/models/{id}/show', 'ModelController@show')->name('extranet.models.show');
    Route::post('/models/store', 'ModelController@store')->name('extranet.models.store');
    Route::put('/models/{model}/update', 'ModelController@update')->name('extranet.models.update');
    Route::delete('/survey/{model}/delete', 'ModelController@delete')->name('extranet.models.delete');

    // Lists
    Route::get('/sitelists', 'Admin\SiteListController@index')->name('extranet.admin.sitelists.index');
    Route::get('/sitelists/create', 'Admin\SiteListController@create')->name('extranet.admin.sitelists.create');
    Route::post('/sitelists/store', 'Admin\SiteListController@store')->name('extranet.admin.sitelists.store');
    Route::get('/sitelists/{sitelist?}', 'Admin\SiteListController@show')->name('extranet.admin.sitelists.show');
    Route::put('/sitelists/{sitelist?}/update', 'Admin\SiteListController@update')->name('extranet.admin.sitelists.update');
    Route::delete('/sitelists/{sitelist?}/delete', 'Admin\SiteListController@delete')->name('extranet.admin.sitelists.delete');


});
