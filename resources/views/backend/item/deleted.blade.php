@extends ('backend.layouts.app')

@section ('title', __('labels.backend.items.management') . ' | ' . __('labels.backend.items.deleted'))

@section('breadcrumb-links')
    @include('backend.item.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.items.management') }}
                        <small class="text-muted">{{ __('labels.backend.items.deleted') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('labels.backend.items.table.id') }}</th>
                                <th>{{ __('labels.backend.items.table.name') }}</th>
                                <th>{{ __('labels.backend.items.table.supplier') }}</th>
                                <th>{{ __('labels.backend.items.table.selling_price') }}</th>
                                <th>{{ __('labels.backend.items.table.buying_price') }}</th>
                                <th>{{ __('labels.backend.items.table.deleted_at') }}</th>
                                <th>{{ __('labels.general.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if ($items->count())
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->supplier->name }}</td>
                                        <td>PHP {{ number_format($item->selling_price, 2) }}</td>
                                        <td>PHP {{ number_format($item->buying_price, 2) }}</td>
                                        <td>{{ $item->deleted_at->diffForHumans() }}</td>
                                        <td>{!! $item->action_buttons !!}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="9"><p class="text-center">{{ __('strings.backend.items.no_deleted') }}</p></td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $items->total() !!} {{ trans_choice('labels.backend.items.table.total', $items->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $items->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
