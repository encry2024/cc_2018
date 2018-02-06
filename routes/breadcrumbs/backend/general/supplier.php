<?php
/**
 * Supplier
 */
Breadcrumbs::register('admin.supplier.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.suppliers.management'), route('admin.supplier.index'));
});

Breadcrumbs::register('admin.supplier.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.create'), route('admin.supplier.create'));
});

Breadcrumbs::register('admin.supplier.show', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.show', ['supplier' => $supplier->name]), route('admin.supplier.show', $supplier));
});

Breadcrumbs::register('admin.supplier.edit', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.edit', ['supplier' => $supplier->name]), route('admin.supplier.edit', $supplier));
});

Breadcrumbs::register('admin.supplier.cart', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.cart', ['supplier' => $supplier->name]), route('admin.supplier.cart', $supplier));
});

Breadcrumbs::register('admin.supplier.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.supplier.index');
    $breadcrumbs->push(__('labels.backend.suppliers.deleted'), route('admin.supplier.deleted'));
});