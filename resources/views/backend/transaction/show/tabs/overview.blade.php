<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>{{ __('labels.backend.items.table.name') }}</th>
                <th>{{ __('labels.backend.items.table.total_price') }}</th>
                <th>{{ __('labels.backend.items.table.quantity') }}</th>
            </tr>
            </thead>

            <tfoot>
            {{--<tr>
                <td colspan="5">{!! $transaction->item_transactions->count() !!} {{ trans_choice('labels.backend.items.table.total', $transaction->item_transactions->count()) }}</td>
            </tr>--}}
            </tfoot>

            <tbody>
            @foreach ($transaction->item_transactions as $item_transaction)
                <tr>
                    <input type="hidden" name="item_id" value="{{ $item_transaction->id }}">
                    <td>{{ $item_transaction->item->name }}</td>
                    <td>PHP {{ number_format($item_transaction->total_price, 2) }}</td>
                    <td>
                        {{ $item_transaction->quantity }} kg
                    </td>
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

        {{--<div class="col-5">
            <div class="float-right">
                {!! $item_transaction->render() !!}
            </div>
        </div><!--col-->--}}
    </div><!--row-->
</div>