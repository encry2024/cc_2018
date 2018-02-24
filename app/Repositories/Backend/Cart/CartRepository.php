<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Cart;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Cart\Cart;
use App\Models\Item\Item;

use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use App\Events\Backend\Cart\CartCreated;
use App\Events\Backend\Cart\CartUpdated;
use App\Events\Backend\Cart\CartRestored;
use App\Events\Backend\Cart\CartPermanentlyDeleted;

/**
 * Class CartRepository.
 */
class CartRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Cart::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     * @param string $status
     *
     * @return mixed
     */
    public function getQueuesPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $status = 'QUEUE', $supplier_id) : LengthAwarePaginator
    {
        return $this->model->whereSupplierId($supplier_id)
            ->with(['item', 'supplier'])
            ->whereStatus($status)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Cart
     */
    public function create(array $data) : Cart
    {
        return DB::transaction(function () use ($data) {
            $item               = Item::find($data['item_id']);

            $quantity           = $data['quantity'];
            $item_selling_price = $item->selling_price;

            $total_price        = $item_selling_price * $quantity;

            $cart = Cart::create([
                'supplier_id'           =>  $item->supplier_id,
                'item_id'               =>  $data['item_id'],
                'total_price'           =>  $total_price,
                'quantity'              =>  $quantity
            ]);

            if ($cart) {
                event(new CartCreated($cart));

                return $cart;
            }

            throw new GeneralException(__('exceptions.backend.carts.create_error'));
        });
    }
}
