<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'architect', 'namespace' => 'Modules\Architect\Http\Controllers'], function()
{
    Route::get('/', 'ArchitectController@index');
    Route::post('/save', 'ArchitectController@save')->name('save');

    // Typologies
    Route::get('/typologies', 'TypologyController@index');
    Route::get('/typologies/create', 'TypologyController@create');

    // Medias
    Route::get('/medias', 'MediaController@index')->name('medias.index');

    // Account
    Route::post('/account/save', ['as' => 'account.save', 'uses' => 'AccountController@save']);
    Route::get('/account', ['as' => 'account', 'uses' => 'AccountController@index']);

    /*
    |--------------------------------------------------------------------------
    | FILE UPLOAD
    |--------------------------------------------------------------------------
    */
    Route::post('/file/upload', ['as' => 'upload-post', 'uses' => 'FileUploadController@postUpload']);

});
