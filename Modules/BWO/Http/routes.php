<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\BWO\Http\Controllers'], function()
{
    Route::get('/', 'BWOController@index')->name('home');
    Route::get('/offers', 'BWOController@offers')->name('offers');

});
