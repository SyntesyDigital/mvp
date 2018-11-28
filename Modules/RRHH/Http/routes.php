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

  Route::get('/offers', 'Admin\Offers\OfferController@index')->name('rrhh.offers');



});
