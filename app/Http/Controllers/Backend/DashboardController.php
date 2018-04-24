<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment\Check\Check;

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
        $checks = Check::where('type', 'post-dated')->get();

        return view('backend.dashboard')->withChecks($checks);
    }
}
