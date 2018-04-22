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
                <td>{{ $customer->discount ? $customer->discount : 'N/A' }} %</td>
            </tr>

            <tr>
                <th>Credit</th>
                <td>
                    <div class="progress" data-toggle="tooltip" title="Usable Credit PHP {{ number_format($customer->credit_limit - ($customer->credit_limit * ($customer->progress_credit / 100)), 2) }}">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $customer->progress_credit }}%" aria-valuenow="{{ $customer->progress_credit }}" aria-valuemin="0" aria-valuemax="100%"
                        >
                        <span>{{ $customer->progress_credit }}% ({{ $customer->current_credit }} / PHP {{ number_format($customer->credit_limit, 2) }})</span>
                        </div>
                    </div>
                </td>
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