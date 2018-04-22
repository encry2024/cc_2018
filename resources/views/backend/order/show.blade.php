@extends ('backend.layouts.app')

@section ('title', __('labels.backend.customers.management') . ' | Order Management')

@section('breadcrumb-links')
    @include('backend.order.includes.breadcrumb-links')
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card {{ $model->status == 'PAID' ? 'bg-success' : ($model->status == 'DELAYED' ? 'bg-danger' : '') }}">
            <div class="form-card-header">
                <h4>Order #{{ $model->id }}
                @include('backend.order.includes.header-buttons')
                </h4>
            </div>

            <div class="card-group">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4 mb-4">
                            <div class="col">
                                @include('backend.order.show.tabs.order_details')
                                <br>
                                @include('backend.order.show.tabs.customer_information')
                            </div><!--col-->
                        </div><!--row-->
                    </div><!--card-body-->
                </div><!--card-->

                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4 mb-4">
                            <div class="col">
                                @include('backend.order.show.tabs.customer_orders')
                            </div><!--col-->
                        </div><!--row-->
                    </div><!--card-body-->
                </div><!--card-->
            </div><!--card-group-->
        </div><!-- card -->
    </div><!--col-->
</div><!--row-->

<br>
@endsection