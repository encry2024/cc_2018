<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Transaction;

use App\Models\Item\Item;
use App\Models\Cart\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Transaction\Transaction;
use App\Models\Transaction\ItemTransaction;

use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use App\Events\Backend\Transaction\TransactionCreated;
use App\Events\Backend\Transaction\TransactionUpdated;
use App\Events\Backend\Transaction\TransactionRestored;
use App\Events\Backend\Transaction\TransactionPermanentlyDeleted;

/**
 * Class TransactionRepository.
 */
class TransactionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     * @param string $status
     *
     * @return mixed
     */
    public function getPendingPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $status = 'PENDING') : LengthAwarePaginator
    {
        return $this->model
            ->where('status', $status)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     * @param string $status
     *
     * @return mixed
     */
    public function getDeliveredPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $status = 'DELIVERED') : LengthAwarePaginator
    {
        return $this->model
            ->where('status', $status)
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
     * @return Transaction
     */
    public function create(array $data) : Transaction
    {
        return DB::transaction(function () use ($data) {
            $transaction = parent::create([
                'user_id'      =>  auth()->id()
            ]);

            if ($transaction) {
                foreach($data['item_order_id'] as $item_id) {
                    $cart = Cart::find($item_id);

                    $transaction->items()->attach($cart, [
                        'quantity'  =>  $cart->quantity,
                        'total_price'   =>  $cart->total_price
                    ]);
                }
                event(new TransactionCreated($transaction));

                return $transaction;
            }

            throw new GeneralException(__('exceptions.backend.items.create_error'));
        });
    }

    /**
     * @param Transaction  $transaction
     * @param array $data
     *
     * @return Transaction
     */
    public function update(Transaction $transaction, array $data) : Transaction
    {
        return DB::transaction(function () use ($transaction, $data) {
            if ($transaction->update([
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
                event(new TransactionUpdated($transaction));

                return $transaction;
            }

            throw new GeneralException(__('exceptions.backend.items.update_error'));
        });
    }

    /**
     * @param Transaction $transaction
     *
     * @return Transaction
     * @throws GeneralException
     */
    public function forceDelete(Transaction $transaction) : Transaction
    {
        if (is_null($transaction->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.item.delete_first'));
        }

        return DB::transaction(function () use ($transaction) {

            if ($transaction->forceDelete()) {
                event(new TransactionPermanentlyDeleted($transaction));

                return $transaction;
            }

            throw new GeneralException(__('exceptions.backend.items.delete_error'));
        });
    }

    /**
     * @param item $transaction
     *
     * @return item
     * @throws GeneralException
     */
    public function restore(Transaction $transaction) : Transaction
    {
        if (is_null($transaction->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.item.cant_restore'));
        }

        if ($transaction->restore()) {
            event(new TransactionRestored($transaction));

            return $transaction;
        }

        throw new GeneralException(__('exceptions.backend.item.restore_error'));
    }
}
