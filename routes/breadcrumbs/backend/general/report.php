<?php
/**
 * Report
 */
Breadcrumbs::register('admin.report.payable', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.payables.management'), route('admin.report.payable'));
});

Breadcrumbs::register('admin.report.receivable', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.receivables.management'), route('admin.report.receivable'));
});