<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Item;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Item\Item;
use App\Models\Item\ItemOrder;

use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use App\Events\Backend\Item\ItemCreated;
use App\Events\Backend\Item\ItemUpdated;
use App\Events\Backend\Item\ItemRestored;
use App\Events\Backend\Item\ItemPermanentlyDeleted;

use App\Events\Backend\ItemOrder\ItemOrderCreated;
use App\Events\Backend\ItemOrder\ItemOrderUpdated;
use App\Events\Backend\ItemOrder\ItemOrderRestored;
use App\Events\Backend\ItemOrder\ItemOrderPermanentlyDeleted;

/**
 * Class ItemRepository.
 */
class ItemRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Item::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
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
     * @param array $data
     *
     * @return Item
     */
    public function create(array $data) : Item
    {
        return DB::transaction(function () use ($data) {
            $item = parent::create([
                'supplier_id'           =>  $data['supplier'],
                'name'                  =>  strtoupper($data['name']),
                'selling_price'         =>  str_replace(',','',$data['selling_price']),
                'buying_price'          =>  str_replace(',','',$data['buying_price']),
                'initial_weight'        =>  str_replace(',','',$data['initial_weight']),
                'initial_weight_type'   =>  'kg',
                'final_weight'          =>  str_replace(',','',$data['final_weight']),
                'final_weight_type'     =>  'kg'
            ]);

            if ($item) {
                event(new ItemCreated($item));

                return $item;
            }

            throw new GeneralException(__('exceptions.backend.items.create_error'));
        });
    }

    /**
     * @param Item  $item
     * @param array $data
     *
     * @return Item
     */
    public function update(Item $item, array $data) : Item
    {
        return DB::transaction(function () use ($item, $data) {
            if ($item->update([
                'supplier_id'           =>  $data['supplier'],
                'name'                  =>  strtoupper($data['name']),
                'selling_price'         =>  str_replace(',','',$data['selling_price']),
                'buying_price'          =>  str_replace(',','',$data['buying_price']),
                'initial_weight'        =>  str_replace(',','',$data['initial_weight']),
                'initial_weight_type'   =>  'kg',
                'final_weight'          =>  str_replace(',','',$data['final_weight']),
                'final_weight_type'     =>  'kg'
            ]))

            {
                event(new ItemUpdated($item));

                return $item;
            }

            throw new GeneralException(__('exceptions.backend.items.update_error'));
        });
    }

    /**
     * @param Item $item
     *
     * @return Item
     * @throws GeneralException
     */
    public function forceDelete(Item $item) : Item
    {
        if (is_null($item->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.item.delete_first'));
        }

        return DB::transaction(function () use ($item) {

            if ($item->forceDelete()) {
                event(new ItemPermanentlyDeleted($item));

                return $item;
            }

            throw new GeneralException(__('exceptions.backend.items.delete_error'));
        });
    }

    /**
     * @param item $item
     *
     * @return item
     * @throws GeneralException
     */
    public function restore(Item $item) : Item
    {
        if (is_null($item->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.item.cant_restore'));
        }

        if ($item->restore()) {
            event(new ItemRestored($item));

            return $item;
        }

        throw new GeneralException(__('exceptions.backend.item.restore_error'));
    }

    /**
     * @param array $data
     *
     * @return ItemOrder
     */
    public function storeOrderedProducts(array $data) : ItemOrder
    {
        return DB::transaction(function () use ($data) {
            $item           = Item::find($data['item_id']);
            $quantity       = $data['quantity'];
            $total_price    = $item->selling_price * $quantity;

            $item_order = ItemOrder::create([
                'supplier_id'           =>  $item->supplier_id,
                'item_id'               =>  $data['item_id'],
                'total_price'           =>  $total_price,
                'quantity'              =>  $quantity
            ]);

            if ($item_order) {
                event(new ItemOrderCreated($item_order));

                return $item_order;
            }

            throw new GeneralException(__('exceptions.backend.item_orders.create_error'));
        });
    }
}
