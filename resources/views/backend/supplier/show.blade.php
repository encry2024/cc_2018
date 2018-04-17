@extends ('backend.layouts.app')

@section ('title', __('labels.backend.suppliers.management') . ' | ' . __('labels.backend.suppliers.view'))

@section('breadcrumb-links')
    @include('backend.supplier.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.suppliers.management') }}
                        <small class="text-muted">{{ __('labels.backend.suppliers.view', ['supplier' => $supplier->name]) }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fa fa-user"></i> {{ __('labels.backend.suppliers.tabs.titles.overview') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#transactions" role="tab" aria-controls="transaction" aria-expanded="true"><i class="fa fa-clone"></i> {{ __('labels.backend.suppliers.tabs.titles.transaction') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#products" role="tab" aria-controls="product" aria-expanded="true"><i class="fa fa-archive" aria-hidden="true"></i> {{ __('labels.backend.suppliers.tabs.titles.products') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            @include('backend.supplier.show.tabs.overview')
                        </div><!--tab-->

                        <div class="tab-pane" id="transactions" role="tabpanel" aria-expanded="true">
                            @include('backend.supplier.show.tabs.transaction')
                        </div><!--tab-->

                        <div class="tab-pane" id="products" role="tabpanel" aria-expanded="true">
                            @include('backend.supplier.show.tabs.products')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>{{ __('labels.backend.suppliers.tabs.content.overview.created_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($supplier->created_at)) }},
                        <strong>{{ __('labels.backend.suppliers.tabs.content.overview.updated_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($supplier->updated_at)) }}
                        @if ($supplier->trashed())
                            <strong>{{ __('labels.backend.suppliers.tabs.content.overview.deleted_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($supplier->deleted_at)) }}
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->

    <script>
        $(function() {
            const order_btn     = $("[name=order_btn]"),
            selling_price_label = $("#order_item_modal").find("#item-selling-price"),
            item_name_label     = $("#order_item_modal").find("#item-name"),
            item_weight_label   = $("#order_item_modal").find("#weight_label"),
            total_cost_label    = $("#order_item_modal").find("#total_cost"),
            requested_quantity  = $("#order_item_modal").find("[name=requested_quantity]"),
            add_to_cart_btn     = $("#order_item_modal").find("[name=add_to_cart]");

            let selling_price   = 0;

            order_btn.on('click', function () {
                const item_name     = $(this).data('item-name'),
                item_id             = $(this).data('item-id'),
                item_selling_price  = $(this).data('item-selling_price'),
                item_weight_type    = $(this).data('item-initial_weight_type');

                selling_price = item_selling_price.replace(",", "");

                selling_price_label.text("PHP " + Number(item_selling_price).toLocaleString(undefined, {minimumFractionDigits: 2}));
                item_name_label.text(item_name);
                item_weight_label.text(item_weight_type);
                add_to_cart_btn.attr('data-value', item_id);
            });

            requested_quantity.on('keyup', function () {
                const quantity      = $(this).val().replace(",", "");
                selling_price       = parseFloat(selling_price);
                const total_cost    = parseFloat(quantity) * selling_price;

                if ( ! isNaN(total_cost)) {
                    total_cost_label.text("PHP " + Number(total_cost).toLocaleString(undefined, {minimumFractionDigits: 2}));
                    add_to_cart_btn.attr("data-item-quantity", quantity);
                } else {
                    total_cost_label.text("PHP 0.00");
                }
            });

            add_to_cart_btn.on('click', function() {
                let item_id     = $(this).data('value');
                let quantity    = $(this).data('item-quantity');

                $.ajax({
                    type: "post",
                    url: "{{ route('admin.cart.store') }}",
                    data: {
                        _token:         '{{ csrf_token() }}',
                        item_id:        item_id,
                        quantity:       quantity,
                        supplier_id:    "{{ $supplier->id }}"
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        notific8("Product '" + data.name + "' has been added to queue.", {
                            life:    5000,
                            theme:  'materialish',
                            color:  'lilrobot'
                        });
                    }
                });
            });
        })
    </script>
@endsection
