@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.suppliers.management'))

@section('breadcrumb-links')
    @include('backend.supplier.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.suppliers.management') }} <small class="text-muted">{{ __('labels.backend.suppliers.list') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.supplier.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('labels.backend.suppliers.table.id') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.name') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.contact_person_full_name') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.email') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.mobile_number') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.created_at') }}</th>
                                    <th>{{ __('labels.backend.suppliers.table.updated_at') }}</th>
                                    <th>{{ __('labels.general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->id }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->full_name }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->mobile_number }}</td>
                                    <td>{{ $supplier->created_at->diffForHumans() }}</td>
                                    <td>{{ $supplier->updated_at->diffForHumans() }}</td>
                                    <td>{!! $supplier->action_buttons !!}</td>
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
                        {!! $suppliers->total() !!} {{ trans_choice('labels.backend.suppliers.table.total', $suppliers->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $suppliers->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
