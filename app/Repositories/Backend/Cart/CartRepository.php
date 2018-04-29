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
use App\Models\Supplier\Supplier;

use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use App\Events\Backend\Cart\CartCreated;
use App\Events\Backend\Cart\CartUpdated;
use App\Events\Backend\Cart\CartRestored;
use App\Events\Backend\Cart\CartDeleted;
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
     * @param string supplier
     *
     * @return mixed
     */
    public function getQueuesPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $status = null, $supplier = null) : LengthAwarePaginator
    {
        if (! is_null($supplier)) {
            $supplier_id = Supplier::where('name', $supplier)->first();

            return $this->model
                ->with(['item', 'supplier'])
                ->whereStatus($status)
                ->whereSupplierId($supplier_id->id)
                ->orderBy($orderBy, $sort)
                ->paginate($paged);
        }

        return $this->model
            ->with(['item', 'supplier'])
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

    public function update(Cart $cart) : Cart
    {
        return DB::transaction(function () use ($cart) {
            if ($cart->status == "QUEUE") {
                if ($cart->update(['status' => 'REQUESTED'])) {
                    return $cart;
                }
            } elseif ($cart->status == "REQUESTED") {
                if ($cart->update(['status' => 'RECEIVED'])) {
                    $cart->cashflow()->create(['amount' => $cart->total_price]);
                    # Item's final weight as stocks
                    $item_stocks    = $cart->item->final_weight;
                    # Stocks from Carts table
                    $ordered_stocks = $cart->quantity;
                    # Total of Item Stocks + Ordered Stocks
                    $total_stocks   = $item_stocks + $ordered_stocks;

                    if ($cart->item->update(['final_weight' => $total_stocks])) {
                        return $cart;
                    }
                }
            }
            throw new GeneralException(__('exceptions.backend.items.update_error'));
        });
    }
}
