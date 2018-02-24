<?php
/**
 * Item
 */
Breadcrumbs::register('admin.transaction.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.transactions.management'), route('admin.transaction.index'));
});

Breadcrumbs::register('admin.transaction.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.transaction.index');
    $breadcrumbs->push(__('labels.backend.transactions.create'), route('admin.transaction.create'));
});

Breadcrumbs::register('admin.transaction.show', function ($breadcrumbs, $transaction) {
    $breadcrumbs->parent('admin.transaction.index');
    $breadcrumbs->push(__('labels.backend.transactions.show', ['transaction' => $transaction->id]), route('admin.transaction.show', $transaction));
});

Breadcrumbs::register('admin.transaction.edit', function ($breadcrumbs, $transaction) {
    $breadcrumbs->parent('admin.transaction.index');
    $breadcrumbs->push(__('labels.backend.transactions.edit', ['transaction' => $transaction->id]), route('admin.transaction.edit', $transaction));
});

Breadcrumbs::register('admin.transaction.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.transaction.index');
    $breadcrumbs->push(__('labels.backend.transactions.deleted'), route('admin.transaction.deleted'));
});