<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Cart',
], function () {
    Route::post('cart', 'CartController@store')->name('cart.store');
});
