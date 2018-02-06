<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Customer;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Customer\Customer;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Customer\CustomerCreated;

use App\Events\Backend\Customer\CustomerUpdated;
use App\Events\Backend\Customer\CustomerRestored;
use App\Events\Backend\Customer\CustomerPermanentlyDeleted;

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
}
