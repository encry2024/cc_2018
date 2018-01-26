<?php

Breadcrumbs::register('admin.supplier.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.suppliers.management'), route('admin.supplier.index'));
});

Breadcrumbs::register('admin.supplier.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.create'), route('admin.supplier.create'));
});

Breadcrumbs::register('admin.supplier.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.show'), route('admin.supplier.show', $id));
});

Breadcrumbs::register('admin.supplier.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.edit'), route('admin.supplier.edit', $id));
});

Breadcrumbs::register('admin.supplier.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.deleted'), route('admin.supplier.deleted'));
});