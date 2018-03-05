<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Cart',
], function () {

    Route::resource('cart', 'CartController');

    Route::get('queues', 'CartController@getCartQueues')->name('cart.queues');

});
