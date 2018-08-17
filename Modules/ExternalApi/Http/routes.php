<?php

Route::group([
    'middleware' => 'web',
    'prefix' => 'externalapi',
    'namespace' => 'Modules\ExternalApi\Http\Controllers'], function() {

    Route::get('/members', 'MemberController@index')->name('members.index');
    Route::get('/programs/{code}/members', 'ProgramController@members')->name('programs.members');
    Route::get('/programs-categories/{code}/members', 'ProgramCategoryController@members')->name('programs-categories.members');

    Route::get('/axes/{id}/indicators', 'AxeController@indicators')->name('axes.indicators');
    Route::get('/indicator/{id}/companies', 'IndicatorController@companies')->name('indicators.companies');
});
