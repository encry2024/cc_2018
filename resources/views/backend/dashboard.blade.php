@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-white">
                    <h5>Dashboard</h5>
                </div><!--card-header-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="list-group">
                <h5 class="list-group-item list-group-item-info">
                    PENDING POST-DATED CHECKS
                </h5>
                @foreach ($checks as $check)
                <a class="list-group-item list-group-item-action align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $check->bank }}</h5>
                        <h6>Date of Claim: {{ date('F d, Y', strtotime($check->date_of_claim)) }}</h6>
                    </div>
                    <p class="mb-1">ORDER #{{ $check->order_id }}</p>
                    <p class="mb-1">ACCOUNT NUMBER: {{ $check->account_number }}</p>
                </a>
                @endforeach
            </div>
        </div><!--col-->

        <div class="col">
            <div class="list-group">
                <h5 class="list-group-item list-group-item-warning">
                    UNPAID ORDERS
                </h5>
                @foreach ($pending_orders as $pending_order)
                <a href="{{ route('admin.order.show', $pending_order->id) }}" class="list-group-item list-group-item-action align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">ORDER #{{ $pending_order->id }}</h5>
                        <h6>Collection Date: {{ date('F d, Y', strtotime($pending_order->collection_date)) }}</h6>
                    </div>
                    <h6>{{ $pending_order->customer->name }}</h6>
                    <h6>{{ strtoupper($pending_order->payment_type) }}</h6>
                    <p class="mb-1">REMAINING BALANCE: PHP {{ number_format($pending_order->balance, 2) }} </p>
                </a>
                @endforeach
            </div><!--list-group-->
        </div><!--col-->
    </div><!--row-->

    <br>
@endsection
