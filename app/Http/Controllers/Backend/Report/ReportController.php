<?php

namespace App\Http\Controllers\Backend\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cashflow\Cashflow;
use App\Http\Requests\Backend\Report\ViewPayableRequest;
use App\Http\Requests\Backend\Report\ViewReceivableRequest;

class ReportController extends Controller
{
    protected $cashflow;

    public function __construct(Cashflow $cashflow)
    {
        $this->cashflow = $cashflow;
    }

    public function viewPayableAccount(ViewPayableRequest $request)
    {
        return view('backend.report.account.payable');
    }

    public function viewReceivableAccount(ViewReceivableRequest $request)
    {
        // $receivables = $this->cashflow->receivable;

        // dd($receivables);

        return view('backend.report.account.receivable');
    }
}
