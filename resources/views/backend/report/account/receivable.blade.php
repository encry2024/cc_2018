@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.receivables.management'))

@section('breadcrumb-links')
    @include('backend.report.account.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.receivables.management') }} <small class="text-muted">{{ __('labels.backend.receivables.list') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('labels.backend.receivables.table.sales_invoice') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.user') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.customer') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.balance') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.status') }}</th>
                                    <th>{{ __('labels.backend.receivables.table.collection') }}</th>
                                    <th>Remaining {{ __('labels.backend.receivables.table.stocks') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $receivables->total() !!} {{ trans_choice('labels.backend.receivables.table.total', $receivables->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $receivables->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
