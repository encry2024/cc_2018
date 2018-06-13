@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.receivables.management'))

@section('breadcrumb-links')
    @include('backend.report.account.includes.receivable.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.receivables.management') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('labels.backend.receivables.table.sales_invoice') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.user') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.customer') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.amount') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.collection') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashflows as $cashflow)
                                    <tr>
                                        <td>{{ $cashflow->cashflowable->paymentable->order->sales_invoice }}</td>
                                        <td>{{ $cashflow->cashflowable->paymentable->order->user->full_name }}</td>
                                        <td>{{ $cashflow->cashflowable->paymentable->order->customer->name }}</td>
                                        <td>PHP {{ number_format($cashflow->cashflowable->amount_paid, 2) }}</td>
                                        <td>{{ date('F d, Y h:i A', strtotime($cashflow->cashflowable->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $cashflows->total() !!} {{ trans_choice('labels.backend.receivables.table.total', $cashflows->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $cashflows->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection