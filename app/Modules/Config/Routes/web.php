
<?php

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect',
        'localeViewPath' ,'auth','IsAdmin','IsSuperAdmin']
], function () {
    Route::group(['prefix' => 'configs' , 'as' => 'configs.'], function () {
        Route::get('/edit', 'ConfigController@getEdit');
        Route::post('/edit', 'ConfigController@postEdit');
  });
});
