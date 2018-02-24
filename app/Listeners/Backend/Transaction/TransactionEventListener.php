<?php

namespace App\Listeners\Backend\Transaction;

/**
 * Class TransactionEventListener.
 */
class TransactionEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Transaction Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Transaction Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Transaction Deleted');
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('Transaction Confirmed');
    }

    /**
     * @param $event
     */
    public function onUnconfirmed($event)
    {
        \Log::info('Transaction Unconfirmed');
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        \Log::info('Transaction Password Changed');
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        \Log::info('Transaction Deactivated');
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        \Log::info('Transaction Reactivated');
    }

    /**
     * @param $event
     */
    public function onSocialDeleted($event)
    {
        \Log::info('Transaction Social Deleted');
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info('Transaction Permanently Deleted');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info('Transaction Restored');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Transaction\TransactionCreated::class,
            'App\Listeners\Backend\Transaction\TransactionEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Transaction\TransactionUpdated::class,
            'App\Listeners\Backend\Transaction\TransactionEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Transaction\TransactionDeleted::class,
            'App\Listeners\Backend\Transaction\TransactionEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Transaction\TransactionPermanentlyDeleted::class,
            'App\Listeners\Backend\Transaction\TransactionEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Transaction\TransactionRestored::class,
            'App\Listeners\Backend\Transaction\TransactionEventListener@onRestored'
        );
    }
}
