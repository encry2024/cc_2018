<?php

namespace App\Http\Controllers\Backend\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
# Models
use App\Models\Customer\Customer;
use App\Models\Order\Order;
# Requests
use App\Http\Requests\Backend\Order\ManageOrderRequest;
use App\Http\Requests\Backend\Order\EditOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Http\Requests\Backend\Order\AddPaymentRequest;
# Repository
use App\Repositories\Backend\Order\OrderRepository;
use App\Http\Requests\Backend\Customer\ManageCustomerRequest;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageOrderRequest $request)
    {
        return view('backend.order.index')->withOrders($this->orderRepository->getOrderPaginated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, ManageOrderRequest $request)
    {
        return view('backend.order.show')->withModel($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order, EditOrderRequest $request)
    {
        return view('backend.order.show')->withModel($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addPayment(Order $order, Request $request)
    {
        $add_payment = $this->orderRepository->addPayment($order, $request->only(
            'payment_dropdown',
            'amount_received',
            'date',
            'account_number',
            'check_type',
            'bank'
        ));

        // return redirect()->back();
    }
}
