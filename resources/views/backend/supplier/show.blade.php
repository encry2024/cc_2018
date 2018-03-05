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
            $(".requested-quantity").on('change', function() {
                let item_quantity_var   =  0,
                    diq                 =  $(this).closest('tr');
                    item_quantity_var   = $(this).val();
                // Debug
                console.log(item_quantity_var);
                // Debug - .data('item-quantity', item_quantity_var)
                diq.find(".order_btn").attr('data-item-quantity', item_quantity_var);

                if(item_quantity_var == 0) {
                    diq.find(".order_btn").attr('disabled', true);
                } else {
                    diq.find(".order_btn").removeAttr('disabled');
                }
            });

            $(".order_btn").on('click', function() {
                let item_id = $(this).data('value');
                let quantity = $(this).data('item-quantity');

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
