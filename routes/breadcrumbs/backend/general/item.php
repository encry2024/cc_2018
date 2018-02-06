<?php
/**
 * Item
 */
Breadcrumbs::register('admin.item.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.items.management'), route('admin.item.index'));
});

Breadcrumbs::register('admin.item.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.item.index');
    $breadcrumbs->push(__('labels.backend.items.create'), route('admin.item.create'));
});

Breadcrumbs::register('admin.item.show', function ($breadcrumbs, $item) {
    $breadcrumbs->parent('admin.item.index');
    $breadcrumbs->push(__('labels.backend.items.show', ['item' => $item->name]), route('admin.item.show', $item));
});

Breadcrumbs::register('admin.item.edit', function ($breadcrumbs, $item) {
    $breadcrumbs->parent('admin.item.index');
    $breadcrumbs->push(__('labels.backend.items.edit', ['item' => $item->name]), route('admin.item.edit', $item));
});

Breadcrumbs::register('admin.item.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.item.index');
    $breadcrumbs->push(__('labels.backend.items.deleted'), route('admin.item.deleted'));
});