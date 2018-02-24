<?php
/**
 * Item
 */
Breadcrumbs::register('admin.customer.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.customers.management'), route('admin.customer.index'));
});

Breadcrumbs::register('admin.customer.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.customer.index');
    $breadcrumbs->push(__('labels.backend.customers.create'), route('admin.customer.create'));
});

Breadcrumbs::register('admin.customer.show', function ($breadcrumbs, $customer) {
    $breadcrumbs->parent('admin.customer.index');
    $breadcrumbs->push(__('labels.backend.customers.show', ['customer' => $customer->name]), route('admin.customer.show', $customer));
});

Breadcrumbs::register('admin.customer.order', function ($breadcrumbs, $customer) {
    $breadcrumbs->parent('admin.customer.index');
    $breadcrumbs->push(__('labels.backend.customers.order', ['customer' => $customer->name]), route('admin.customer.order', $customer));
});

Breadcrumbs::register('admin.customer.edit', function ($breadcrumbs, $customer) {
    $breadcrumbs->parent('admin.customer.index');
    $breadcrumbs->push(__('labels.backend.customers.edit', ['customer' => $customer->name]), route('admin.customer.edit', $customer));
});

Breadcrumbs::register('admin.customer.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.customer.index');
    $breadcrumbs->push(__('labels.backend.customers.deleted'), route('admin.customer.deleted'));
});