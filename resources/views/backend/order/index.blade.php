@extends ('backend.layouts.app')

@section ('title', app_name() . ' | Order Management')

@section('breadcrumb-links')
    @include('backend.order.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Order Management <small class="text-muted">Order List</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer Name</th>
                                    <th>Issued by</th>
                                    <th>Balance</th>
                                    <th>Collection Date</th>
                                    <th>Payment Type</th>
                                    <th>{{ __('labels.backend.suppliers.table.created_at') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.updated_at') }}</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->user->full_name }}</td>
                                    <td>{!! $order->status != "PAID" ? $order->remaining_balance : "<label class='badge badge-success' style='font-size: 13px;'>Paid</label>" !!}</td>
                                    <td>{{ date('F d, Y', strtotime($order->collection_date)) }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ date('F d, Y', strtotime($order->created_at)) }}</td>
                                    <td>{{ date('F d, Y', strtotime($order->updated_at)) }}</td>
                                    <td>{!! $order->action_buttons !!}</td>
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
                        {!! $orders->total() !!} Order(s)
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $orders->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
