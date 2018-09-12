<?php

Route::get('sitemap.xml', 'Modules\Turisme\Http\Controllers\SitemapController@sitemap')->name('sitemap');

Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => ['web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath','localize'],
  'namespace' => 'Modules\Turisme\Http\Controllers'
], function() {
    Route::get('/countries/list', 'CountriesController@list')->name('countries.list');
    Route::get('/preview/{id}', 'ContentController@preview')->name('preview');
    Route::put('/contact/save', 'ContactController@save')->name('contact.save');
    Route::put('/contact/newsletter', 'ContactController@saveNewsletter')->name('contact.newsletter');
    Route::put('/contact/save-with-selection', 'ContactController@saveWithSelection')->name('contact.save.selection');
    Route::put('/contact/save-press', 'ContactController@savePress')->name('contact.save.press');
    Route::get('/', 'ContentController@index')->name('home');

    Route::get('/{slug}','ContentController@show')
      ->where('slug', '([A-Za-z0-9\-\/]+)')
      ->name('content.show');

    // Localization to JS
    Route::get('js/lang-{locale}.js', 'LocalizationController@index')->name('messages');
    Route::get('js/localization-{locale}.js', 'LocalizationController@localization')->name('localization.js');
});
