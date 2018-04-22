<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Customer;

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
# Events
use App\Events\Backend\Customer\CustomerUpdated;
use App\Events\Backend\Customer\CustomerRestored;
use App\Events\Backend\Customer\CustomerPermanentlyDeleted;
use App\Events\Backend\Customer\CustomerCreated;

/**
 * Class CustomerRepository.
 */
class CustomerRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Customer::class;
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
     * @return Customer
     */
    public function create(array $data) : Customer
    {
        return DB::transaction(function () use ($data) {
            $customer = parent::create([
                'name'              =>  strtoupper($data['name']),
                'email'             =>  $data['email'],
                'contact_number'    =>  $data['contact_number'],
                'address'           =>  $data['address'],
                'discount'          =>  $data['discount'],
                'credit_limit'      =>  str_replace(',','',$data['credit_limit'])
            ]);

            if ($customer) {

                event(new CustomerCreated($customer));

                return $customer;
            }

            throw new GeneralException(__('exceptions.backend.customers.create_error'));
        });
    }

    /**
     * @param Customer  $customer
     * @param array $data
     *
     * @return Customer
     */
    public function update(Customer $customer, array $data) : Customer
    {
        return DB::transaction(function () use ($customer, $data) {
            if ($customer->update([
                'name'              =>  strtoupper($data['name']),
                'email'             =>  $data['email'],
                'contact_number'    =>  $data['contact_number'],
                'address'           =>  $data['address'],
                'discount'          =>  $data['discount'],
                'credit_limit'      =>  str_replace(',','',$data['credit_limit'])
            ]))

            {
                event(new CustomerUpdated($customer));

                return $customer;
            }

            throw new GeneralException(__('exceptions.backend.customers.update_error'));
        });
    }

    /**
     * @param Customer $customer
     *
     * @return Customer
     * @throws GeneralException
     */
    public function forceDelete(Customer $customer) : Customer
    {
        if (is_null($customer->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.customer.delete_first'));
        }

        return DB::transaction(function () use ($customer) {

            if ($customer->forceDelete()) {
                event(new CustomerPermanentlyDeleted($customer));

                return $customer;
            }

            throw new GeneralException(__('exceptions.backend.customers.delete_error'));
        });
    }

    /**
     * @param customer $customer
     *
     * @return customer
     * @throws GeneralException
     */
    public function restore(Customer $customer) : Customer
    {
        if (is_null($customer->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.customer.cant_restore'));
        }

        if ($customer->restore()) {
            event(new CustomerRestored($customer));

            return $customer;
        }

        throw new GeneralException(__('exceptions.backend.customer.restore_error'));
    }

    public function storeCustomerOrder(Customer $customer, $data)
    {
        return DB::transaction(function () use ($customer, $data) {
            $orders = $customer->orders()->create([
                'user_id'         => Auth::user()->id,
                'collection_date' => $data['collection_date'],
                'balance'         => str_replace(",", "", $data['balance']),
                'payment_type'    => str_replace(",", "", $data['payment_type']),
                'note'            => 'Test Note'
            ]);

            if ($orders) {
                $item_orders = $orders->item_orders()->createMany((array) $data['customer_orders']);

                if ($item_orders) {
                    foreach ($item_orders as $item_order) {
                        $requested_stocks       = $item_order->requested_quantity;

                        $item                   = Item::find($item_order->item_id);
                        $item_current_stocks    = $item->final_weight;
                        $remaining_stocks       = $item_current_stocks - $requested_stocks;

                        $item->update(['final_weight' => $remaining_stocks]);
                    }

                    return true;
                }

                return false;
            }

            return false;
        });
    }
}
