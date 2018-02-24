<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Customer',
], function () {

    Route::get('customer/deleted', 'CustomerStatusController@getDeleted')->name('customer.deleted');

    Route::get('customer/{customer}/order', 'CustomerController@order')->name('customer.order');

    Route::resource('customer', 'CustomerController');

    // Route::get('customer/create', 'CustomerController@create')->name('customer.create');

    Route::group(['prefix' => 'customer/{deletedCustomer}'], function () {
        Route::get('delete', 'CustomerStatusController@delete')->name('customer.delete-permanently');
        Route::get('restore', 'CustomerStatusController@restore')->name('customer.restore');
    });

});
