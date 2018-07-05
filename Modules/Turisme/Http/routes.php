<?php



Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [ 'web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath','localize'],
  'namespace' => 'Modules\Turisme\Http\Controllers'], function()
{
    Route::get('/', 'ContentController@index');

    // Localization to JS
    Route::get('js/lang-{locale}.js', 'LocalizationController@index')->name('messages');
});
