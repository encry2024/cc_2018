<?php

namespace App\Listeners\Backend\Customer;

/**
 * Class CustomerEventListener.
 */
class CustomerEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Customer Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Customer Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Customer Deleted');
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('Customer Confirmed');
    }

    /**
     * @param $event
     */
    public function onUnconfirmed($event)
    {
        \Log::info('Customer Unconfirmed');
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        \Log::info('Customer Password Changed');
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        \Log::info('Customer Deactivated');
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        \Log::info('Customer Reactivated');
    }

    /**
     * @param $event
     */
    public function onSocialDeleted($event)
    {
        \Log::info('Customer Social Deleted');
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info('Customer Permanently Deleted');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info('Customer Restored');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Customer\CustomerCreated::class,
            'App\Listeners\Backend\Customer\CustomerEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Customer\CustomerUpdated::class,
            'App\Listeners\Backend\Customer\CustomerEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Customer\CustomerDeleted::class,
            'App\Listeners\Backend\Customer\CustomerEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Customer\CustomerPermanentlyDeleted::class,
            'App\Listeners\Backend\Customer\CustomerEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Customer\CustomerRestored::class,
            'App\Listeners\Backend\Customer\CustomerEventListener@onRestored'
        );
    }
}
