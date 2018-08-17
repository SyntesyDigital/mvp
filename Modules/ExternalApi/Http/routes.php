<?php

Route::group([
    'middleware' => 'web',
    'prefix' => 'externalapi',
    'namespace' => 'Modules\ExternalApi\Http\Controllers'], function() {

    Route::get('/members', 'MemberController@index')->name('members.index');
    Route::get('/programs/{code}/members', 'ProgramController@members')->name('programs.members');
    Route::get('/programs-categories/{code}/members', 'ProgramCategoryController@members')->name('programs-categories.members');

    // Route::get('/axes/{id}/indicators', 'AxeController@indicators')->name('axes.indicators');
    // Route::get('/axes/{id}', 'AxeController@show')->name('axes.show');
    // Route::get('/indicator/{id}/companies', 'IndicatorController@companies')->name('indicators.companies');

    Route::get('/companies', 'CompanyController@all')->name('companies.all');
    Route::get('/indicators', 'IndicatorController@all')->name('indicators.all');
    Route::get('/axes', 'AxeController@all')->name('axes.all');

    Route::get('/agencies', 'AgencyController@all')->name('agencies.all');
    Route::get('/agencies-categories', 'AgencyCategoryController@all')->name('agencies-categories.all');
});
