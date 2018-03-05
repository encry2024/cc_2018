@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.carts.management'))

@section('breadcrumb-links')
    @include('backend.cart.includes.breadcrumb-links')
@endsection

@section('content')
    

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.carts.management') }}
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('labels.backend.carts.table.status') }}</th>
                                    <th>{{ __('labels.backend.carts.table.item') }}</th>
                                    <th>{{ __('labels.backend.carts.table.quantity') }}</th>
                                    <th>{{ __('labels.backend.carts.table.supplier') }}</th>
                                    <th>{{ __('labels.backend.carts.table.date_ordered') }}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($carts as $cart)
                                <tr>
                                    <td>{!! $cart->status == 'QUEUE' ? '<label class="badge badge-dark" style="font-size:10px;">QUEUE</label>' : '<label class="badge badge-info" style="font-size:10px;">'.$cart->status.'</label>' !!}</td>
                                    <td>{{ $cart->item->name }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>{{ $cart->supplier->name }}</td>
                                    <td>{{ $cart->created_at }}</td>
                                    <td>{!! $cart->action_buttons !!}</td>
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
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
