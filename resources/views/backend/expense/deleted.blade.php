@extends ('backend.layouts.app')

@section ('title', __('labels.backend.expenses.management') . ' | ' . __('labels.backend.expenses.deleted'))

@section('breadcrumb-links')
    @include('backend.expense.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.expenses.management') }}
                        <small class="text-muted">{{ __('labels.backend.expenses.deleted') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('labels.backend.expenses.table.code') }}</th>
                                    <th>{{ __('labels.backend.expenses.table.user') }}</th>
                                    <th>{{ __('labels.backend.expenses.table.requested_by') }}</th>
                                    <th>{{ __('labels.backend.expenses.table.created_at') }}</th>
                                    <th>{{ __('labels.backend.expenses.table.updated_at') }}</th>
                                    <th>{{ __('labels.general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($expenses->count())
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->code }}</td>
                                        <td>{{ $expense->user->full_name }}</td>
                                        <td>{{ $expense->requested_by }}</td>
                                        <td>{{ date('F d, Y (h:i A)', strtotime($expense->created_at)) }}</td>
                                        <td>{{ date('F d, Y (h:i A)', strtotime($expense->updated_at)) }}</td>
                                        <td>{!! $expense->action_buttons !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="6"><p class="text-center">{{ __('strings.backend.expenses.no_deleted') }}</p></td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $expenses->total() !!} {{ trans_choice('labels.backend.expenses.table.total', $expenses->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $expenses->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
