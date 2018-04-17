<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('labels.backend.items.table.name') }}</th>
                    <th>{{ __('labels.backend.items.table.selling_price') }}</th>
                    <th>{{ __('labels.general.actions') }}</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <td colspan="5">{!! $products->total() !!} {{ trans_choice('labels.backend.items.table.total', $products->total()) }}</td>
                </tr>
            </tfoot>

            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>PHP {{ number_format($product->selling_price, 2) }}</td>
                    <td>{!! $product->order_button !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="float-right">
                {!! $products->render() !!}
            </div>
        </div><!--col-->
    </div><!--row-->
</div>