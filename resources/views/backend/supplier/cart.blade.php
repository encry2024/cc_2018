@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.suppliers.management'))

@section('breadcrumb-links')
    @include('backend.supplier.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.suppliers.management') }} <small class="text-muted">{{ __('labels.backend.suppliers.cart') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table cart-table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 4%;"><input type="checkbox" id="check-all-btn"></th>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Date Ordered</th>
                                </tr>
                            </thead>

                            <tbody>
                            {{ html()->form('POST', route('admin.supplier.confirm_orders'))->class('form-horizontal')->id('cart_form')->open() }}
                            @foreach ($queues as $queue)
                                <tr>
                                    <td><input type="checkbox" value="{{ $queue->id }}"></td>
                                    <td>{{ $queue->id }}</td>
                                    <td>{{ $queue->item->name }}</td>
                                    <td>{{ $queue->quantity }} kg</td>
                                    <td>PHP {{ number_format($queue->total_price, 2) }}</td>
                                    <td>{{ date('F d, Y - h:i A', strtotime($queue->created_at)) }}</td>
                                </tr>
                            @endforeach
                            {{ html()->form()->close() }}
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->

            <div class="row">
                <button class="btn btn-success">Confirm</button>
            </div>

            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $queues->total() !!} {{ trans_choice('labels.backend.suppliers.table.queues', $queues->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $queues->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->

    <script>
        $(function () {
            $("#check-all-btn").click(function(){
                $('input:checkbox').not(this).attr('checked', this.checked);
            });
        });
    </script>
@endsection
