<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'architect', 'namespace' => 'Modules\Architect\Http\Controllers'], function()
{
    Route::get('/', 'ArchitectController@index');
});
