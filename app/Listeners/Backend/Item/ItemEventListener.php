<?php

namespace App\Listeners\Backend\Item;

/**
 * Class ItemEventListener.
 */
class ItemEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Item "'. $event->item .'" Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Item Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Item Deleted');
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('Item Confirmed');
    }

    /**
     * @param $event
     */
    public function onUnconfirmed($event)
    {
        \Log::info('Item Unconfirmed');
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        \Log::info('Item Password Changed');
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        \Log::info('Item Deactivated');
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        \Log::info('Item Reactivated');
    }

    /**
     * @param $event
     */
    public function onSocialDeleted($event)
    {
        \Log::info('Item Social Deleted');
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info('Item Permanently Deleted');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info('Item Restored');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Item\ItemCreated::class,
            'App\Listeners\Backend\Item\ItemEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Item\ItemUpdated::class,
            'App\Listeners\Backend\Item\ItemEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Item\ItemDeleted::class,
            'App\Listeners\Backend\Item\ItemEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Item\ItemPermanentlyDeleted::class,
            'App\Listeners\Backend\Item\ItemEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Item\ItemRestored::class,
            'App\Listeners\Backend\Item\ItemEventListener@onRestored'
        );
    }
}
