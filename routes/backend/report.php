<?php

Route::group([
    'namespace' => 'Report',
    'prefix'    => 'report',
    'as'        => 'report.'
], function () {

    Route::get('receivable', 'ReportController@viewReceivableAccount')->name('receivable');
    Route::get('payable', 'ReportController@viewPayableAccount')->name('payable');

});