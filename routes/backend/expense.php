<?php

Route::group([
    'namespace' => 'Expense'
], function () {
    Route::get('expense/deleted', 'ExpenseStatusController@getDeleted')->name('expense.deleted');

    Route::resource('expense', 'ExpenseController');

    Route::group(['prefix' => 'expense/{deletedExpense}'], function () {
        Route::get('delete', 'ExpenseStatusController@delete')->name('expense.delete-permanently');
        Route::get('restore', 'ExpenseStatusController@restore')->name('expense.restore');
    });

});