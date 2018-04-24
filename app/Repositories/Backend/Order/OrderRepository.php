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
            $payment_method = $data["payment_dropdown"];
            $cash           = new Cash;
            $check          = new Check;

            if ($payment_method == "Cash") {
                $payment = $cash->create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'date_paid' => date('Y-m-d')
                ])->payment()->create(['amount_paid' => str_replace(",", "", $data['amount_received'])]);

                if ($payment) {
                    // Get Amount
                    $order_balance     = $order->balance;
                    $amount_received   = $payment->amount_paid;

                    // Get remaining balance
                    $remaining_balance = $order_balance - $amount_received;

                    // If
                    if ($remaining_balance <= 0) {
                        $order->update(['balance' => 0, 'status' => 'PAID']);

                        return $order;
                    }

                    // Do not update order status if not fully paid
                    $order->update(['balance' => $remaining_balance]);

                    return $order;
                }
            } else {
                $payment = $check->create([
                    'account_number' => $data['account_number'],
                    'bank'           => $data['bank'],
                    'date_of_claim'  => $data['date'],
                    'type'           => $data['check_type'],
                    'user_id'        => Auth::user()->id,
                    'order_id'       => $order->id
                ])->payment()->create(['amount_paid' => str_replace(",", "", $data['amount_received'])]);

                if ($payment) {
                    $order_balance     = $order->balance;
                    $amount_received   = $payment->amount_paid;

                    $remaining_balance = $order_balance - $amount_received;

                    if ($remaining_balance <= 0) {
                        $order->update(['balance' => 0, 'status' => 'PAID']);

                        return $order;
                    }

                    $order->update(['balance' => $remaining_balance]);

                    return $order;
                }
            }

            throw new GeneralException('Something went wrong when adding a payment to Order #'.$order->id);
        });
    }
}
