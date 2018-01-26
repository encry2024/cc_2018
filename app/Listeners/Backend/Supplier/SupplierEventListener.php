<?php

namespace App\Listeners\Backend\Supplier;

/**
 * Class SupplierEventListener.
 */
class SupplierEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Supplier Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Supplier Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Supplier Deleted');
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('Supplier Confirmed');
    }

    /**
     * @param $event
     */
    public function onUnconfirmed($event)
    {
        \Log::info('Supplier Unconfirmed');
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        \Log::info('Supplier Password Changed');
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        \Log::info('Supplier Deactivated');
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        \Log::info('Supplier Reactivated');
    }

    /**
     * @param $event
     */
    public function onSocialDeleted($event)
    {
        \Log::info('Supplier Social Deleted');
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info('Supplier Permanently Deleted');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info('Supplier Restored');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Supplier\SupplierCreated::class,
            'App\Listeners\Backend\Supplier\SupplierEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Supplier\SupplierUpdated::class,
            'App\Listeners\Backend\Supplier\SupplierEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Supplier\SupplierDeleted::class,
            'App\Listeners\Backend\Supplier\SupplierEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Supplier\SupplierPermanentlyDeleted::class,
            'App\Listeners\Backend\Supplier\SupplierEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Supplier\SupplierRestored::class,
            'App\Listeners\Backend\Supplier\SupplierEventListener@onRestored'
        );
    }
}
