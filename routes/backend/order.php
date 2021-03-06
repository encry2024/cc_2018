<?php


Route::group([
    'namespace' => 'Order'
], function () {

    Route::get('order/deleted', 'OrderStatusController@getDeleted')->name('order.deleted');

    Route::patch('order/payment/{payment}/check/{check}/update_status', 'OrderController@updateCheck')->name('order.update_check');

    Route::resource('order', 'OrderController');

    Route::group(['prefix' => 'order/{deletedOrder}'], function () {
        Route::get('delete', 'OrderStatusController@delete')->name('order.delete-permanently');
        Route::get('restore', 'OrderStatusController@restore')->name('order.restore');
    });

    Route::group(['prefix' => 'order/{order}'], function () {
        Route::post('add_payment', 'OrderController@addPayment')->name('order.add_payment');
    });
});