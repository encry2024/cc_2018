@extends ('backend.layouts.app')

@section ('title', app_name() . ' | Request Management')

@section('breadcrumb-links')
    @include('backend.supplier.request.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.suppliers.management') }} <small class="text-muted">{{ __('labels.backend.suppliers.list') }}</small>
                    </h4><!--card-title-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('labels.backend.items.table.name') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.name') }}</th>
                                    <th>{{ __('labels.backend.items.table.quantity') }}</th>
                                    <th>Total Price</th>
                                    <th>{{ __('labels.backend.suppliers.table.created_at') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.updated_at') }}</th>
                                    <th>{{ __('labels.general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td>{{ $request->item->name }}</td>
                                    <td>{{ $request->supplier->name }}</td>
                                    <td>{{ number_format($request->quantity, 2) }} kg</td>
                                    <td>PHP {{ number_format($request->total_price, 2) }}</td>
                                    <td>{{ date('F d, Y (h:i A)', strtotime($request->created_at)) }}</td>
                                    <td>{{ date('F d, Y (h:i A)', strtotime($request->updated_at)) }}</td>
                                    <td>{!! $request->action_buttons !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!--table-responsive-->
                </div><!--col-->
            </div><!--row-->

            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $requests->total() !!} Request(s) Total
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $requests->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
