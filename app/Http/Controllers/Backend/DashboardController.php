<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment\Check\Check;
use App\Models\Order\Order;
use App\Models\Cashflow\Cashflow;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $checks             = Check::where('type', 'post-dated')->where('status', 'PENDING')->get();
        $pending_orders     = Order::where('status', 'PENDING')->get();
        $cashflows          = Cashflow::whereDate('created_at', date('Y-m-d'))->get();
        $total_payables     = Cashflow::totalPayables();
        $total_receivables  = Cashflow::totalReceivables();
        $graph_receivables  = Cashflow::receivables();
        $graph_orders       = Cashflow::orders();
        $graph_expenses     = Cashflow::expenses();

        return view('backend.dashboard')
            ->withChecks($checks)
            ->with('pending_orders', $pending_orders)
            ->withCashflows($cashflows)
            ->withReceivables($total_receivables)
            ->withPayables($total_payables)
            ->with('graph_receivables', $graph_receivables)
            ->with('graph_orders', $graph_orders)
            ->with('graph_expenses', $graph_expenses);
    }
}
