<?php

namespace App\Http\Controllers\Backend\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cashflow\Cashflow;
use App\Http\Requests\Backend\Report\ViewPayableRequest;
use App\Http\Requests\Backend\Report\ViewReceivableRequest;

class ReportController extends Controller
{
    public function viewPayableAccount(ViewPayableRequest $request)
    {
        return view('backend.report.account.payable');
    }

    public function viewReceivableAccount(ViewReceivableRequest $request)
    {
        $cashflows = Cashflow::where('cashflowable_type', 'App\Models\Payment\Payment\Payment')->paginate(25);

        // dd($cashflows);

        return view('backend.report.account.receivable')->withCashflows($cashflows);
    }
}
