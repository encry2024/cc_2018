@extends ('backend.layouts.app')

@section ('title', __('labels.backend.transactions.management') . ' | ' . __('labels.backend.transactions.view'))

@section('breadcrumb-links')
    @include('backend.transaction.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.transactions.management') }}
                        <small class="text-muted">{{ __('labels.backend.transactions.view', ['transaction' => $transaction->id]) }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-transaction">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true">Products Ordered</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                            @include('backend.transaction.show.tabs.overview')
                        </div><!--tab-->
                    </div><!--tab-content-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                        <strong>{{ __('labels.backend.transactions.tabs.content.overview.created_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($transaction->created_at)) }},
                        <strong>{{ __('labels.backend.transactions.tabs.content.overview.updated_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($transaction->updated_at)) }}
                        @if ($transaction->trashed())
                            <strong>{{ __('labels.backend.transactions.tabs.content.overview.deleted_at') }}:</strong> {{ date('F d, Y (h:i A)', strtotime($transaction->deleted_at)) }}
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
