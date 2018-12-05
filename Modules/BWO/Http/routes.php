<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\BWO\Http\Controllers'], function()
{
    Route::get('/', 'BWOController@index')->name('home');
});
