<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6">
            <div class="table-responsive">
                <table class="table cart-table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('labels.backend.items.table.name') }}</th>
                            <th>{{ __('labels.backend.items.table.supplier') }}</th>
                            <th>{{ __('labels.backend.items.table.buying_price') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($items as $item)
                        <tr class="{{ $item->stocks ? '' : 'bg-danger' }} item-order-button-row"
                            @if($item->stocks == 0)
                                onclick="restockFunction('{{ route('admin.item.show', $item->id) }}');"
                            @else
                                onclick="orderItem({{ $item->id }}, '{{ $item->name }}', '{{ $item->stocks }} kg', '{{ $item->supplier->name }}', 'PHP {{ number_format($item->buying_price, 2) }}');"
                            @endif
                            >
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->supplier->name }}</td>
                            <td>PHP {{ number_format($item->buying_price, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <label class="card-header">Orders</label>
                <div class="card-body-order" style="height: 20rem;">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <th style="background-color: #666; color: white; width: 30%;">Item</th>
                            <th style="background-color: #666; color: white; width: 13%;">Price</th>
                            <th style="background-color: #666; color: white; width: 13%;">Quantity</th>
                            <th style="background-color: #666; color: white; width: 13%;">Cost</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>