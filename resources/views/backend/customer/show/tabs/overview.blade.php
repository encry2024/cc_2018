<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.customers.tabs.content.overview.name') }}</th>
                <td>{{ $customer->name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.customers.tabs.content.overview.email') }}</th>
                <td>{{ $customer->email }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.customers.tabs.content.overview.contact_number') }}</th>
                <td>{{ $customer->contact_number }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.customers.tabs.content.overview.address') }}</th>
                <td>{{ $customer->address }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.customers.tabs.content.overview.discount') }}</th>
                <td>% {{ $customer->discount ? $customer->discount : 'N/A' }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.customers.tabs.content.overview.credit_limit') }}</th>
                <td>PHP {{ number_format($customer->credit_limit, 2) }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.customers.tabs.content.overview.created_at') }}</th>
                <td>{{ $customer->created_at->diffForHumans() }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.customers.tabs.content.overview.updated_at') }}</th>
                <td>{{ $customer->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->