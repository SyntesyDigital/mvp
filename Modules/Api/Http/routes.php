<?php



Route::group(['middleware' => ['web','auth:veos-ws'], 'prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    Route::get('/contents', 'ContentController@index');
    Route::post('/contents', 'ContentController@index');

    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/tree', 'CategoryController@tree');

    Route::get('/elements', 'ElementController@index');
    Route::get('/parameters', 'ElementController@parameters');

    Route::get('/tags', 'TagController@index');

    Route::get('/search', 'SearchController@search');
});
