@extends ('backend.layouts.app')

@section ('title', __('labels.backend.customers.management') . ' | ' . __('labels.backend.customers.order'))

@section('breadcrumb-links')
    @include('backend.customer.includes.breadcrumb-links')
@endsection

@section('content')
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

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    @include('backend.customer.show.con_carne.inventory')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->

    <script>
        // Show Item
        function restockFunction(showItem)
        {
            window.location.href = showItem;
        }

        // Order Item
        function orderItem(itemId, itemName, itemStock, itemSupplier, itemBuyingPrice)
        {
            $("#order-item-modal").modal('show');

            document.getElementById("item-name").innerHTML = itemName;
            document.getElementById("item-stocks").innerHTML = itemStock;
            document.getElementById("item-supplier").innerHTML = itemSupplier;
            document.getElementById("item-buying-price").innerHTML = itemBuyingPrice;
        }

        $(document).ready(function() {
            $("#add-to-tray").click(function() {

            });
        })
    </script>
@endsection
