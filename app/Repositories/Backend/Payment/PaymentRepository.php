<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Payment;

# Facades
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
# Models
use App\Models\Payment\Payment\Payment;

/**
 * Class PaymentRepository.
 */
class PaymentRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Payment::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaymentPaginated($order_id = null, $paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with(['paymentable' => function ($query) use ($order_id) {
                $query->where('order_id', '=', $order_id);
            }])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

}
