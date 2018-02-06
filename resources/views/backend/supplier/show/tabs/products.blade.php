<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('labels.backend.items.table.id') }}</th>
                    <th>{{ __('labels.backend.items.table.name') }}</th>
                    <th>{{ __('labels.backend.items.table.selling_price') }}</th>
                    <th>{{ __('labels.backend.items.table.quantity') }}</th>
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
                    <input type="hidden" name="item_id" value="{{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>PHP {{ number_format($product->selling_price, 2) }}</td>
                    <td>
                        <div class="form-group row">
                            <div class="input-group col-sm-10">
                                <span class="input-group-prepend input-group-text">kg</span>
                                <input type="number" name="item_quantity" class="form-control requested-quantity" min="0" value="0">
                            </div><!--col-->
                        </div><!--form-group-->
                    </td>
                    <td>{!! $product->order_button !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        {{--<div class="col-7">--}}
            {{--<div class="float-left">--}}
                {{----}}
            {{--</div>--}}
        {{--</div><!--col-->--}}

        <div class="col-5">
            <div class="float-right">
                {!! $products->render() !!}
            </div>
        </div><!--col-->
    </div><!--row-->
</div>