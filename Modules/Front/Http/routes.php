<?php

//Route::get('sitemap.xml', 'Modules\Front\Http\Controllers\SitemapController@sitemap')->name('sitemap');

Route::group([
  //'prefix' => LaravelLocalization::setLocale(),
  //'middleware' => ['web','auth:veos-ws','localeSessionRedirect', 'localeViewPath','localize'],
  'middleware' => ['web','auth:veos-ws', 'roles:ROLE_SUPERADMIN,ROLE_SYSTEM'],
  'namespace' => 'Modules\Front\Http\Controllers'
], function() {
    Route::get('/preview/{id}', 'ContentController@preview')->name('preview');
});


Route::group([
  //'prefix' => LaravelLocalization::setLocale(),
  'middleware' => ['web','auth:veos-ws', 'roles:ROLE_SUPERADMIN,ROLE_SYSTEM,ROLE_ADMIN,ROLE_USER'],
  'namespace' => 'Modules\Front\Http\Controllers'
], function() {

    Route::get(LaravelLocalization::transRoute('routes.category.index'), 'CategoryController@index')->name('blog.category.index');
    Route::get(LaravelLocalization::transRoute('routes.tag.index'), 'TagController@index')->name('blog.tag.index');
    Route::get(LaravelLocalization::transRoute('search'), 'ContentController@search')->name('front.search');

    Route::get('/', 'ContentController@index')->name('home');
    Route::get('/document/show/{id}', 'ContentController@showDocument')->name('document.show');
    Route::get('/not-found', 'ContentController@languageNotFound')->name('language-not-found');

    // Localization to JS
    Route::get('js/lang-{locale}.js', 'LocalizationController@index')->name('messages');
    Route::get('js/localization-{locale}.js', 'LocalizationController@localization')->name('localization.js');

    Route::get('/{slug}','ContentController@show')
      ->where('slug', '([A-Za-z0-9\-\/]+)')
      ->name('content.show');
});
