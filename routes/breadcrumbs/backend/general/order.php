<?php
/**
 * Cart
 */
Breadcrumbs::register('admin.order.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Order Management', route('admin.order.index'));
});

Breadcrumbs::register('admin.order.show', function ($breadcrumbs, $order) {
    $breadcrumbs->parent('admin.order.index');
    $breadcrumbs->push('Order #' . $order->id, route('admin.order.show', $order));
});