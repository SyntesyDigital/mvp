<?php

Route::group(['middleware' => 'profileJsonResponse', 'prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    Route::get('/contents', 'ContentController@index');
    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/tree', 'CategoryController@tree');
});
