<?php

//Route::get('sitemap.xml', 'Modules\Front\Http\Controllers\SitemapController@sitemap')->name('sitemap');

/*
Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => ['web','auth:veos-ws','localeSessionRedirect', 'localizationRedirect', 'localeViewPath','localize'],
  'namespace' => 'Modules\Front\Http\Controllers'
], function() {
    Route::get('/countries/list', 'CountriesController@list')->name('countries.list');
    Route::get('/preview/{id}', 'ContentController@preview')->name('preview');
    Route::put('/contact/save', 'ContactController@save')->name('contact.save');
    Route::put('/contact/newsletter', 'ContactController@saveNewsletter')->name('contact.newsletter');
    Route::put('/contact/save-with-selection', 'ContactController@saveWithSelection')->name('contact.save.selection');
    Route::put('/contact/save-press', 'ContactController@savePress')->name('contact.save.press');

    Route::get('/download/{id}', 'ContactController@downloadFile')->name('contact.download');

    Route::get(LaravelLocalization::transRoute('routes.category.index'), 'CategoryController@index')->name('blog.category.index');
    Route::get(LaravelLocalization::transRoute('routes.tag.index'), 'TagController@index')->name('blog.tag.index');
    Route::get(LaravelLocalization::transRoute('search'), 'ContentController@search')->name('front.search');

    Route::get('/', 'ContentController@index')->name('home');
    Route::get('/not-found', 'ContentController@languageNotFound')->name('language-not-found');

    // Localization to JS
    Route::get('js/lang-{locale}.js', 'LocalizationController@index')->name('messages');
    Route::get('js/localization-{locale}.js', 'LocalizationController@localization')->name('localization.js');

    Route::get('/{slug}','ContentController@show')
      ->where('slug', '([A-Za-z0-9\-\/]+)')
      ->name('content.show');
});
*/
