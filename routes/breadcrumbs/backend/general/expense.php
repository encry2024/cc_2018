<?php
/**
 * Cart
 */
Breadcrumbs::register('admin.expense.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.expenses.management'), route('admin.expense.index'));
});

Breadcrumbs::register('admin.expense.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.expense.index');
    $breadcrumbs->push(__('labels.backend.expenses.create'), route('admin.expense.create'));
});

Breadcrumbs::register('admin.expense.show', function ($breadcrumbs, $expense) {
    $breadcrumbs->parent('admin.expense.index');
    $breadcrumbs->push(__('labels.backend.expenses.show', ['expense' => $expense->name]), route('admin.expense.show', $expense));
});

Breadcrumbs::register('admin.expense.edit', function ($breadcrumbs, $expense) {
    $breadcrumbs->parent('admin.expense.index');
    $breadcrumbs->push(__('labels.backend.expenses.edit', ['expense' => $expense->name]), route('admin.expense.edit', $expense));
});

Breadcrumbs::register('admin.expense.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.expense.index');
    $breadcrumbs->push(__('labels.backend.expenses.deleted'), route('admin.expense.deleted'));
});