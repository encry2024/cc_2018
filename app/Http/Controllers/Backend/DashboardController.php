<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment\Check\Check;
use App\Models\Order\Order;

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
        $checks     = Check::where('type', 'post-dated')->where('status', 'PENDING')->get();
        $pending_orders   = Order::where('status', 'PENDING')->get();

        return view('backend.dashboard')->withChecks($checks)->with('pending_orders', $pending_orders);
    }
}
