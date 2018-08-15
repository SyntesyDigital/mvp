<?php


Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => ['web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath','localize'],
  'namespace' => 'Modules\Turisme\Http\Controllers'
], function() {

    Route::get('/preview/{id}', 'ContentController@preview')->name('preview');

    Route::get('/', 'ContentController@index')->name('home');
/*
    Route::get('/{slug}','ContentController@show')
      ->where('slug', '([A-Za-z0-9\-\/]+)')
      ->name('content.show');
*/

    // Localization to JS
    Route::get('js/lang-{locale}.js', 'LocalizationController@index')->name('messages');
});

