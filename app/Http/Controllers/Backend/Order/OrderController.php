<?php

namespace App\Http\Controllers\Backend\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
# Models
use App\Models\Customer\Customer;
use App\Models\Order\Order;
use App\Models\Payment\Payment\Payment;
use App\Models\Payment\Check\Check;
# Requests
use App\Http\Requests\Backend\Order\ManageOrderRequest;
use App\Http\Requests\Backend\Order\EditOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Http\Requests\Backend\Order\AddPaymentRequest;
# Repository
use App\Repositories\Backend\Order\OrderRepository;
use App\Repositories\Backend\Payment\PaymentRepository;
use App\Http\Requests\Backend\Customer\ManageCustomerRequest;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $paymentRepository;

    public function __construct(OrderRepository $orderRepository, PaymentRepository $paymentRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
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
        return view('backend.order.show')->withModel($order)
            ->withPayments($this->paymentRepository->getPaymentPaginated($order->id));
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

        return redirect()->back()->withFlashSuccess("You have successfully added a payment in Order Receipt #".$add_payment->id);
    }

    /**
     * Update Check is for Post-Dated Checks only.
     */
    public function updateCheck(Payment $payment, Check $check, ManageOrderRequest $request)
    {
        $update_check = $check->update(['status' => 'RECEIVED']);

        if ($update_check) {
            // If update check return true; Create cashflow.
            $payment->cashflow()->create(['amount' => $payment->amount_paid]);

            $amount_received = $payment->amount_paid;
            $order_balance = $check->order->balance;

            $remaining_balance = $order_balance - $amount_received;

            if ($remaining_balance <= 0) {
                $check->order->update(['balance' => 0, 'status' => 'PAID']);

                return redirect()->back()->withFlashSuccess("Order #".$check->order->id." is now fully paid.");
            }

            if ($check->order->update(['balance' => $remaining_balance])) {
                return redirect()->back()->withFlashSuccess("You have received an amount of PHP ".number_format($check->payment[0]->amount_paid, 2)." from [Post-Dated Check: ".$check->account_number."] and was deducted to Order's balance.");
            }
        }
    }
}
