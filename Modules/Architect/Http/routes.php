<?php

Route::group(['middleware' => 'web', 'prefix' => 'architect', 'namespace' => 'Modules\Architect\Http\Controllers'], function()
{
    Route::get('/', 'ArchitectController@index');
});
