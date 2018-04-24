<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Order;

# Facades
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
# Models
use App\Models\Customer\Customer;
use App\Models\Order\Order;
use App\Models\Item\Item;
use App\Models\Payment\Payment\Payment;
use App\Models\Payment\Cash\Cash;
use App\Models\Payment\Check\Check;

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    public function generate_random_reference()
    {

    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getOrderPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with(['customer', 'user'])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param Customer  $customer
     * @param array $data
     *
     * @return Customer
     */
    public function update(Order $order, array $data) : Order
    {
        return DB::transaction(function () use ($order, $data) {
            if ($order->update([
                'status' =>  strtoupper($data['status']),
            ]))

            {
                return $order;
            }

            throw new GeneralException('Something went wrong when update this orders status. Please contact the developer.');
        });
    }

    public function addPayment(Order $order, $data) : Order
    {
        # Test Process
        return DB::transaction(function () use ($order, $data) {
            $cash = new Cash;
            $check = new Check;

            if ($cash->payment->create([
                ''
            ]))

            throw new GeneralException('Something went wrong when adding a payment to Order #'.$order->id);
        });
        # Main Process
        // return DB::transaction(function () use ($order, $data) {
        //     $payment = $order->payments()->create([
        //         'user_id' => Auth::user()->id,
        //         'paymentable_type' => 'App\\Models\\Payment\\'.$data['payment_dropdown'].'\\'.$data['payment_dropdown']
        //     ]);

        //     if ($payment)

        //     {
        //         $payment_method = $data["payment_dropdown"];

        //         if ($payment_method == "Cash") {
        //             $paymentable = $payment->cashes()->create([
        //                 'amount_paid'   => str_replace(",", "", $data['amount_received']),
        //                 'date_paid'     => date('Y-m-d')
        //             ]);

        //             if ($paymentable)

        //             {
        //                 if ($payment->update(['paymentable_id' => $paymentable->id]))
        //                 {
        //                     return $order;
        //                 }
        //             }
        //         } else {
        //             $paymentable = $payment->checks()->create([
        //                 'account_number' => $data['account_number'],
        //                 'bank'           => $data['bank'],
        //                 'amount_paid'    => str_replace(",", "", $data['amount_received']),
        //                 'date_of_claim'  => $data['date'],
        //                 'type'           => $data['check_type']
        //             ]);

        //             if ($payment) {

        //                 if ($payment->update(['paymentable_id' => $paymentable->id]))
        //                 {
        //                     return $order;
        //                 }
        //             }
        //         }
        //     }

        //     throw new GeneralException('Something went wrong when adding a payment to Order #'.$order->id);
        // });
    }
}
