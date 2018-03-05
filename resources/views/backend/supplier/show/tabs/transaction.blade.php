<div class="col">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('labels.backend.transactions.table.id') }}</th>
                    <th>{{ __('labels.backend.transactions.table.user') }}</th>
                    <th>{{ __('labels.backend.transactions.table.status') }}</th>
                    <th>{{ __('labels.backend.transactions.table.created_at') }}</th>
                    <th>{{ __('labels.backend.transactions.table.updated_at') }}</th>
                    <th>{{ __('labels.general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplier->transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user->full_name }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>{{ $transaction->created_at->diffForHumans() }}</td>
                        <td>{{ $transaction->updated_at->diffForHumans() }}</td>
                        <td>{!! $transaction->action_buttons !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>