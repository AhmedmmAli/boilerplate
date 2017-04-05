<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');
});


Route::resource('posts', 'PostsController');
Route::get('dashboard', 'PostsController@index')->name('dashboard');
Route::get('admin', 'PostsController@Adminposts')->name('admin');
Route::get('update', 'PostsController@changestatus')->name('update');


Route::get('gogo', function($locale) {
    $post = new Posts();
    //$post->save();
    $postr = new PostTranslation();
    foreach (['en', 'ar'] as $locale) {
        $postr->translateOrNew($locale)->name = "Title {$locale}";
        $postr->translateOrNew($locale)->text = "Text {$locale}";
    }

    $postr->save();

    echo 'Created an article with some translations!';
});