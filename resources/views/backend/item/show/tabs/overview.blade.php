<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.items.tabs.content.overview.name') }}</th>
                <td>{{ $item->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.items.tabs.content.overview.supplier') }}</th>
                <td><a href="{{ route('admin.supplier.show', $item->supplier->id) }}">{{ $item->supplier->name }}</a></td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.items.tabs.content.overview.initial_weight') }}</th>
                <td>{{ $item->initial_weight }} {{ $item->initial_weight_type }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.items.tabs.content.overview.final_weight') }}/Remaining {{ __('labels.backend.items.tabs.content.overview.stocks') }}</th>
                <td>{{ $item->final_weight }} {{ $item->final_weight_type }}  | Critical Level: {{ $item->critical_stocks_level }} {{ $item->final_weight_type }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.items.tabs.content.overview.selling_price') }}</th>
                <td>PHP {{ number_format($item->selling_price, 2) }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.items.tabs.content.overview.buying_price') }}</th>
                <td>PHP {{ number_format($item->buying_price, 2) }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.items.tabs.content.overview.created_at') }}</th>
                <td>{{ date('F d, Y (h:i A)', strtotime($item->created_at)) }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.items.tabs.content.overview.updated_at') }}</th>
                <td>{{ date('F d, Y (h:i A)', strtotime($item->updated_at)) }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->