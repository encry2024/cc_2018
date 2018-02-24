<?php

namespace App\Listeners\Backend\Cart;

/**
 * Class CartEventListener.
 */
class CartEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Cart Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Cart Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Cart Deleted');
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('Cart Confirmed');
    }

    /**
     * @param $event
     */
    public function onUnconfirmed($event)
    {
        \Log::info('Cart Unconfirmed');
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        \Log::info('Cart Password Changed');
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        \Log::info('Cart Deactivated');
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        \Log::info('Cart Reactivated');
    }

    /**
     * @param $event
     */
    public function onSocialDeleted($event)
    {
        \Log::info('Cart Social Deleted');
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info('Cart Permanently Deleted');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info('Cart Restored');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Cart\CartCreated::class,
            'App\Listeners\Backend\Cart\CartEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Cart\CartUpdated::class,
            'App\Listeners\Backend\Cart\CartEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Cart\CartDeleted::class,
            'App\Listeners\Backend\Cart\CartEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Cart\CartPermanentlyDeleted::class,
            'App\Listeners\Backend\Cart\CartEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Cart\CartRestored::class,
            'App\Listeners\Backend\Cart\CartEventListener@onRestored'
        );
    }
}
