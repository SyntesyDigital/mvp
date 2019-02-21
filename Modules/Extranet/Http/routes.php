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

    // Offers
    Route::get('/models', 'Admin\ModelController@index')->name('extranet.admin.models.index');

    // Lists
    Route::get('/sitelists', 'Admin\SiteListController@index')->name('extranet.admin.sitelists.index');
    Route::get('/sitelists/create', 'Admin\SiteListController@create')->name('extranet.admin.sitelists.create');
    Route::post('/sitelists/store', 'Admin\SiteListController@store')->name('extranet.admin.sitelists.store');
    Route::get('/sitelists/{sitelist?}', 'Admin\SiteListController@show')->name('extranet.admin.sitelists.show');
    Route::put('/sitelists/{sitelist?}/update', 'Admin\SiteListController@update')->name('extranet.admin.sitelists.update');
    Route::delete('/sitelists/{sitelist?}/delete', 'Admin\SiteListController@delete')->name('extranet.admin.sitelists.delete');


});
