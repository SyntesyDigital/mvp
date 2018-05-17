<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'architect', 'namespace' => 'Modules\Architect\Http\Controllers'], function()
{
    Route::get('/', 'ArchitectController@index')->name('home');
    Route::post('/save', 'ArchitectController@save')->name('save');

    // Typologies
    Route::get('/typologies', 'TypologiesController@index')->name('typologies');
    Route::get('/typologies/show', 'TypologiesController@show')->name('typologies.show');

    // Medias
    Route::get('/medias', 'MediaController@index')->name('medias.index');

    // Account
    Route::post('/account/save', 'AccountController@save')->name('account.save');
    Route::get('/account', 'AccountController@index')->name('account');

    /*
    |--------------------------------------------------------------------------
    | FILE UPLOAD
    |--------------------------------------------------------------------------
    */
    Route::post('/file/upload', ['as' => 'upload-post', 'uses' => 'FileUploadController@postUpload']);

});
