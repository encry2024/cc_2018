<?php
/**
 * Request
 */
Breadcrumbs::register('admin.request.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Requested Items', route('admin.request.index'));
});