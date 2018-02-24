<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Item',
], function () {

    Route::get('item/deleted', 'ItemStatusController@getDeleted')->name('item.deleted');

    Route::get('item/queues', 'ItemController@getItemQueues')->name('item.queue');

    Route::post('item_order/confirmed', 'ItemOrderController@confirmOrders')->name('item_order.confirm_orders');

    Route::resource('item', 'ItemController');
    Route::resource('item_order', 'ItemOrderController');

    Route::group(['prefix' => 'item/{deletedItem}'], function () {
        Route::get('delete', 'ItemStatusController@delete')->name('item.delete-permanently');
        Route::get('restore', 'ItemStatusController@restore')->name('item.restore');
    });

});
