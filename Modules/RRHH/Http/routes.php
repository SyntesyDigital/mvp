<?php
/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::group([
  'middleware' => ['web', 'auth','role:admin', 'DetectUserLocale'],
  'prefix' => 'architect',
  'namespace' => 'Modules\RRHH\Http\Controllers'
], function()
{

    Route::get('/offers', 'Admin\Offers\OfferController@index')->name('rrhh.admin.offers.index');
    Route::get('/offers/data', 'Admin\Offers\OfferController@data')->name('rrhh.admin.offers.index.data');
    Route::get('/offers/data/recipients', 'Admin\Offers\OfferController@recipients')->name('rrhh.admin.offers.index.data.recipients');
    Route::get('/offers/create', 'Admin\Offers\OfferController@create')->name('rrhh.admin.offers.create');
    Route::post('/offers/store', 'Admin\Offers\OfferController@store')->name('rrhh.admin.offers.store');
    Route::get('/offers/{offer?}', 'Admin\Offers\OfferController@show')->name('rrhh.admin.offers.show');
    Route::put('/offers/{offer?}/update', 'Admin\Offers\OfferController@update')->name('rrhh.admin.offers.update');
    Route::delete('/offers/{offer?}/delete', 'Admin\Offers\OfferController@delete')->name('rrhh.admin.offers.delete');


});
