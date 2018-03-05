<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Supplier',
], function () {

    Route::get('supplier/deleted', 'SupplierStatusController@getDeleted')->name('supplier.deleted');
    Route::get('supplier/{supplier}/item/cart', 'SupplierController@showCart')->name('supplier.cart');
    Route::get('supplier/queues', 'SupplierController@getSupplierQueuesCount')->name('supplier.queues');

    Route::resource('supplier', 'SupplierController');

    Route::group(['prefix' => 'supplier/{deletedSupplier}'], function () {
        Route::get('delete', 'SupplierStatusController@delete')->name('supplier.delete-permanently');
        Route::get('restore', 'SupplierStatusController@restore')->name('supplier.restore');
    });

});
