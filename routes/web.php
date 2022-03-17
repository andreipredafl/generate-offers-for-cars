<?php

Route::redirect('/', '/homepage');

Route::get('/homepage', function() {
    return view('homepage');
})->name('homepage');

Route::get('/offer/{token}', 'HomeController@offer');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'OfferController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Field
    Route::delete('fields/destroy', 'FieldController@massDestroy')->name('fields.massDestroy');
    Route::resource('fields', 'FieldController');

    // Offer
    Route::delete('offers/destroy', 'OfferController@massDestroy')->name('offers.massDestroy');
    Route::post('offers/media', 'OfferController@storeMedia')->name('offers.storeMedia');
    Route::post('offers/ckmedia', 'OfferController@storeCKEditorImages')->name('offers.storeCKEditorImages');
    Route::resource('offers', 'OfferController');

    // Offer Field
    Route::delete('offer-fields/destroy', 'OfferFieldController@massDestroy')->name('offer-fields.massDestroy');
    Route::resource('offer-fields', 'OfferFieldController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});