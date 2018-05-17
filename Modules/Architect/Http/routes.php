<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'architect', 'namespace' => 'Modules\Architect\Http\Controllers'], function()
{
    Route::get('/', 'ArchitectController@index')->name('home');
    Route::post('/save', 'ArchitectController@save')->name('save');


    Route::get('/typologies', 'TypologiesController@index')->name('typologies');
    Route::get('/typologies/show', 'TypologiesController@show')->name('typologies.show');

});
