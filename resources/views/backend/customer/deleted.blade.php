@extends ('backend.layouts.app')

@section ('title', __('labels.backend.customers.management') . ' | ' . __('labels.backend.customers.deleted'))

@section('breadcrumb-links')
    @include('backend.customer.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.customers.management') }}
                        <small class="text-muted">{{ __('labels.backend.customers.deleted') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('labels.backend.customers.table.id') }}</th>
                                <th>{{ __('labels.backend.customers.table.name') }}</th>
                                <th>{{ __('labels.backend.customers.table.contact_number') }}</th>
                                <th>{{ __('labels.backend.customers.table.email') }}</th>
                                <th>{{ __('labels.backend.customers.table.deleted_at') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if ($customers->count())
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->contact_number }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->deleted_at->diffForHumans() }}</td>
                                        <td>{!! $customer->action_buttons !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="9"><p class="text-center">{{ __('strings.backend.customers.no_deleted') }}</p></td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $customers->total() !!} {{ trans_choice('labels.backend.customers.table.total', $customers->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $customers->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
