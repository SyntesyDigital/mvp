<?php

Route::group([
    'prefix' => 'turismeexternal',
    'namespace' => 'Modules\TurismeExternal\Http\Controllers'
], function()  {
    Route::get('/members', 'MemberController@index')->name('turismeexternal.members.index');

    Route::get('/programs', 'ProgramController@index')->name('turismeexternal.programs.index');

    Route::get('/programs/{code}/members', 'ProgramController@members')->name('turismeexternal.programs.members');
    Route::get('/categories/{code}/members', 'CategoryController@members')->name('turismeexternal.categories.members');
});
