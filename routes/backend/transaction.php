<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Transaction',
], function () {

    Route::get('transaction/deleted', 'TransactionStatusController@getDeleted')->name('transaction.deleted');

    Route::post('transaction/store/ordered_products', 'TransactionController@storeOrderedProducts')->name('transaction.store_order');

    Route::resource('transaction', 'TransactionController');
    // Route::resource('item_transaction', 'TransactionOrderController');

    Route::group(['prefix' => 'transaction/{deletedTransaction}'], function () {
        Route::get('delete', 'TransactionStatusController@delete')->name('transaction.delete-permanently');
        Route::get('restore', 'TransactionStatusController@restore')->name('transaction.restore');
    });

});
