@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="row">
    <div class="col">
        <div class="card border-info">
            <div class="form-card-header border-info">
                <h4>Cashflow Line Graph</h4>
            </div>

            <div class="card-body border-info">
                <div id="breakdown_container"></div>
            </div>
        </div>

        <hr>

        <div class="card-group">
            <div class="card">
                <h5 class="card-header">Receivables</h5>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">
                            <h6>Total Amount Receivables</h6>
                            <h4>PHP {{ number_format($receivables, 2) }}</h4>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <table class="table table-striped">
                                <thead>
                                    <th>Amount Received</th>
                                    <th>Payment Type</th>
                                    <th>User</th>
                                </thead>

                                <tbody>
                                    @foreach ($cashflows as $cashflow)
                                        @if ($cashflow->type == "Payment")
                                        <tr>
                                            <td>PHP {{ number_format($cashflow->amount, 2) }}</td>
                                            <td>{{ $cashflow->cashflowable->paymentable->type == null ? "Cash" : ucwords($cashflow->cashflowable->paymentable->type, "-") }}</td>
                                            <td>{{ $cashflow->cashflowable->paymentable->user->full_name }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->
            </div><!--card-->

            <div class="card">
                <h5 class="card-header">Payables</h5>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">
                        <h6>Total Amount Payables</h6>
                        <h4>PHP {{ number_format($payables, 2) }}</h4>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <table class="table table-striped">
                                <thead>
                                    <th>Amount Payable</th>
                                </thead>

                                <tbody>
                                    @foreach ($cashflows as $cashflow)
                                        @if ($cashflow->type != "Payment")
                                        <tr>
                                            <td>
                                                <p>PHP {{ number_format($cashflow->amount, 2) }}<span class="pull-right">{{ $cashflow->type }}</span></p>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->
            </div><!--card-->
        </div><!--card-group-->
    </div><!--col-->
</div><!--row-->

<hr>

<div class="row">
    <div class="col">
        <div class="list-group">
            <h6 class="list-group-item list-group-item-info">
                PENDING POST-DATED CHECKS
            </h6>
            @if ($checks->count())
                @foreach ($checks as $check)
                <a class="list-group-item list-group-item-action align-items-start" style="padding: 3px 10px;">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">{{ $check->bank }}</h6>
                        <h6>Date of Claim: {{ date('F d, Y', strtotime($check->date_of_claim)) }}</h6>
                    </div>
                    <p class="mb-1">ORDER #{{ $check->order_id }}</p>
                    <p class="mb-1">ACCOUNT NUMBER: {{ $check->account_number }}</p>
                </a>
                @endforeach
            @else
                <label class="list-group-item list-group-item-action align-items-start disabled"><i class="fa fa-info-circle"></i> There are no pending Post-Dated Checks</label>
            @endif
        </div>
    </div><!--col-->

    <div class="col">
        <div class="list-group">
            <h6 class="list-group-item list-group-item-warning">
                UNPAID ORDERS
            </h6>
            @if ($pending_orders->count())
                @foreach ($pending_orders as $pending_order)
                <a href="{{ route('admin.order.show', $pending_order->id) }}" class="list-group-item list-group-item-action align-items-start" style="padding: 3px 10px;">
                    <div class="d-flex w-100 justify-content-between">
                        <label class="mb-1 form-control-label">ORDER #{{ $pending_order->id }}</label>
                        <label class="form-control-label">Collection Date: {{ date('F d, Y', strtotime($pending_order->collection_date)) }}</label>
                    </div>
                    <h6>{{ $pending_order->customer->name }}</h6>
                    <h6>{{ strtoupper($pending_order->payment_type) }}</h6>
                    <p class="mb-1">Remaining Balance: PHP {{ number_format($pending_order->balance, 2) }} </p>
                </a>
                @endforeach
            @else
            <label class="list-group-item list-group-item-action align-items-start disabled"><i class="fa fa-info-circle"></i> There are no pending Orders</label>
            @endif
        </div><!--list-group-->
    </div><!--col-->
</div><!--row-->

<br>
@endsection

@push('after-scripts')
<script>
    Highcharts.chart('breakdown_container', {
        chart: {
            type: 'column'
        },

        title: {
            text: 'Cashflow Breakdown'
        },

        xAxis: {
            type: 'category'
        },

        yAxis: {
            title: {
                text: 'Breakdown Cashflow Activity'
            },
            min: 0,
        },

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: 'Amount: PHP {point.y:,.2f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{point.key}</span><br>',
            pointFormat: '<span style="color:{series.color}">Amount</span>: <b>PHP {point.y:,.2f}</b><br/>'
        },

        series: [{
            name: 'Cashflow',
            colorByPoint: true,
            data: [{
                name: "Receivables",
                y: parseFloat("{!! $graph_receivables !!}")
            }, {
                name: "Orders to Suppliers",
                y: parseFloat("{!! $graph_orders !!}")
            }, {
                name: "Expenses",
                y: parseFloat("{!! $graph_expenses !!}")
            }]
        }]
    });
    $('.highcharts-credits').hide();
</script>
@endpush