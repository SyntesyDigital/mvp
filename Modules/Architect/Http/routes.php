<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'architect', 'namespace' => 'Modules\Architect\Http\Controllers'], function()
{
    Route::get('/', 'ArchitectController@index')->name('home');
    Route::get('/settings', 'ArchitectController@settings')->name('settings');
    Route::post('/save', 'ArchitectController@save')->name('save');

    // Typologies
    Route::get('/typologies', 'TypologyController@index')->name('typologies');
    Route::post('/typologies', 'TypologyController@store')->name('typologies.store');
    Route::get('/typologies/create', 'TypologyController@create')->name('typologies.create');
    Route::put('/typologies/{typology?}/update', 'TypologyController@update')->name('typologies.update');
    Route::delete('/typologies/{typology?}/delete', 'TypologyController@delete')->name('typologies.delete');
    Route::get('/typologies/{typology?}', 'TypologyController@show')->name('typologies.show');

    // Categories
    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::get('/categories/data', 'CategoryController@data')->name('categories.data');
    Route::post('/categories/update-order', 'CategoryController@updateOrder')->name('categories.update-order');
    Route::post('/categories', 'CategoryController@store')->name('categories.store');
    Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
    Route::put('/categories/{category?}/update', 'CategoryController@update')->name('categories.update');
    Route::delete('/categories/{category?}/delete', 'CategoryController@delete')->name('categories.delete');
    Route::get('/categories/{category?}', 'CategoryController@show')->name('categories.show');

    // Tags
    Route::get('/tags', 'TagController@index')->name('tags');
    Route::get('/tags/data', 'TagController@data')->name('tags.data');
    Route::post('/tags', 'TagController@store')->name('tags.store');
    Route::get('/tags/create', 'TagController@create')->name('tags.create');
    Route::put('/tags/{tag?}/update', 'TagController@update')->name('tags.update');
    Route::delete('/tags/{tag?}/delete', 'TagController@delete')->name('tags.delete');
    Route::get('/tags/{tag?}', 'TagController@show')->name('tags.show');

    // Contents
    Route::get('/contents', 'ContentController@index')->name('contents');
    Route::get('/contents/data', 'ContentController@data')->name('contents.data');
    Route::get('/contents/modal-data', 'ContentController@modalData')->name('contents.modal.data');
    Route::post('/contents', 'ContentController@store')->name('contents.store');
    Route::get('/contents/show', 'ContentController@show')->name('contents.show');
    Route::get('/contents/page/create', 'ContentController@create')->name('contents.page.create');
    Route::get('/contents/{typology}/create', 'ContentController@create')->name('contents.create');
    Route::get('/contents/{content?}', 'ContentController@show')->name('contents.show');
    Route::put('/contents/{content?}/update', 'ContentController@update')->name('contents.update');
    Route::delete('/contents/{content?}/delete', 'ContentController@delete')->name('contents.delete');

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
