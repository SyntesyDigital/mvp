<?php

Route::get('sitemap.xml', 'Modules\BWO\Http\Controllers\SitemapController@sitemap')->name('sitemap');
Route::group(['middleware' => 'web', 'namespace' => 'Modules\BWO\Http\Controllers'], function()
{
    Route::get('/', 'BWOController@index')->name('home');
    Route::get('/offers', 'BWOController@offers')->name('offers');
    Route::get('/offer', 'BWOController@offer')->name('offer');
    Route::get('/blog', 'BWOController@blog')->name('blog');
    Route::get('/post', 'BWOController@post')->name('post');
});
