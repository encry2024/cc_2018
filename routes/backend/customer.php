<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Customer',
], function () {

    Route::get('customer/deleted', 'CustomerStatusController@getDeleted')->name('customer.deleted');

    Route::resource('customer', 'CustomerController');

    Route::group(['prefix' => 'customer/{deletedCustomer}'], function () {
        Route::get('delete', 'CustomerStatusController@delete')->name('customer.delete-permanently');
        Route::get('restore', 'CustomerStatusController@restore')->name('customer.restore');
    });

});
