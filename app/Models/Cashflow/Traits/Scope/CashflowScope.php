<?php

namespace App\Models\Cashflow\Traits\Scope;

/**
 * Class CashflowScope.
 */
trait CashflowScope
{
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeTotalReceivables($query)
    {
        return $query
            ->where('cashflowable_type', '=', 'App\Models\Payment\Payment\Payment')
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('amount');
    }

        /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeTotalPayables($query)
    {
        return $query
            ->where('cashflowable_type', '!=', 'App\Models\Payment\Payment\Payment')
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('amount');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeReceivables($query)
    {
        return $query
            ->where('cashflowable_type', '=', 'App\Models\Payment\Payment\Payment')
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('amount');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOrders($query)
    {
        return $query
            ->where('cashflowable_type', '=', 'App\Models\Cart\Cart')
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('amount');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeExpenses($query)
    {
        return $query
            ->where('cashflowable_type', '=', 'App\Models\Accounts\Expense\Expense')
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('amount');
    }
}
