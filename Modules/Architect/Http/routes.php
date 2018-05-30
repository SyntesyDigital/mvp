<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'architect', 'namespace' => 'Modules\Architect\Http\Controllers'], function()
{
    Route::get('/', 'ArchitectController@index')->name('home');
    Route::post('/save', 'ArchitectController@save')->name('save');

    // Typologies
    Route::get('/typologies', 'TypologiesController@index')->name('typologies');
    Route::post('/typologies', 'TypologiesController@store')->name('typologies.store');
    Route::get('/typologies/create', 'TypologiesController@create')->name('typologies.create');
    Route::get('/typologies/{typology?}', 'TypologiesController@show')->name('typologies.show');
    Route::put('/typologies/{typology?}/update', 'TypologiesController@update')->name('typologies.update');

    // Contents
    Route::get('/contents', 'ContentController@index')->name('contents');
    Route::get('/contents/data', 'ContentController@data')->name('contents.data');
    Route::post('/contents', 'ContentController@store')->name('contents.store');
    Route::get('/contents/show', 'ContentController@show')->name('contents.show');
    Route::get('/contents/{typology}/create', 'ContentController@create')->name('contents.create');
    Route::get('/contents/{content?}', 'ContentController@show')->name('contents.show');
    Route::put('/contents/{content?}/update', 'ContentController@update')->name('contents.update');

    // Medias
    Route::get('/medias', 'MediaController@index')->name('medias.index');
    Route::get('/medias/data', 'MediaController@data')->name('medias.data');
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
