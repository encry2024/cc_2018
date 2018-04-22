@extends ('backend.layouts.app')

@section ('title', __('labels.backend.customers.management') . ' | ' . __('labels.backend.customers.order'))

@section('breadcrumb-links')
    @include('backend.customer.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="card-title mb-0">
                                {{ __('labels.backend.customers.management') }}
                                <small class="text-muted">{{ __('labels.backend.customers.order') }}</small>
                            </h4>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div id="ajaxSpinnerContainer">
                <div id="ajaxSpinner"></div>
            </div>

            <div class="card-group">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4 mb-4">
                            <div class="col">
                                @include('backend.customer.show.con_carne.order_menu')
                            </div><!--col-->
                        </div><!--row-->
                    </div><!--card-body-->
                </div><!--card-->

                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4 mb-4">
                            <div class="col">
                                @include('backend.customer.show.con_carne.customer_order')
                            </div><!--col-->
                        </div><!--row-->
                    </div><!--card-body-->
                </div><!--card-->
            </div><!--card-group-->

            <div class="from-card-footer bg-white">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.customer.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        <button class="btn btn-success btn-sm" id="create_order_btn">Create Order</button>
                    </div><!--col-->
                </div><!--card-footer-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <br>
@endsection

@push('after-scripts')
    @include('backend.customer.scripts.ordering_script')
@endpush