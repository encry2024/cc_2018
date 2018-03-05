<?php
/**
 * Cart
 */
Breadcrumbs::register('admin.cart.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.carts.management'), route('admin.cart.index'));
});