@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.transactions.management'))

@section('breadcrumb-links')
    @include('backend.transaction.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.transactions.management') }} <small class="text-muted">{{ __('labels.backend.transactions.list') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.transaction.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
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
                                @foreach ($transactions as $transaction)
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
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $transactions->total() !!} {{ trans_choice('labels.backend.transactions.table.total', $transactions->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $transactions->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
