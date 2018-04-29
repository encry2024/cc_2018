<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.expenses.tabs.content.overview.user') }}</th>
                <td>{{ $model->user->full_name }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.expenses.tabs.content.overview.requested_by') }}</th>
                <td>{{ $model->requested_by }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.expenses.tabs.content.overview.cause') }}</th>
                <td>{{ $model->cause }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.expenses.tabs.content.overview.amount') }}</th>
                <td>PHP {{ number_format($model->amount, 2) }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.expenses.tabs.content.overview.created_at') }}</th>
                <td>{{ $model->created_at->diffForHumans() }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.expenses.tabs.content.overview.updated_at') }}</th>
                <td>{{ $model->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->