<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'architect', 'namespace' => 'Modules\Architect\Http\Controllers'], function()
{
    Route::get('/', 'ArchitectController@index')->name('home');
    Route::post('/save', 'ArchitectController@save')->name('save');

    // Typologies
    Route::get('/typologies', 'TypologiesController@index')->name('typologies');
    Route::get('/typologies/show', 'TypologiesController@show')->name('typologies.show');

    // Contents
    Route::get('/contents', 'ContentController@index')->name('contents');
    Route::get('/contents/show', 'ContentController@show')->name('contents.show');


    // Medias
    Route::get('/medias', 'MediaController@index')->name('medias.index');
    Route::post('/medias', 'MediaController@store')->name('medias.store');
    Route::get('/medias/{media?}', 'MediaController@show')->name('medias.show');
    Route::delete('/medias/{media?}/delete', 'MediaController@delete')->name('medias.delete');
    Route::put('/medias/{media?}/update', 'MediaController@update')->name('medias.update');

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
