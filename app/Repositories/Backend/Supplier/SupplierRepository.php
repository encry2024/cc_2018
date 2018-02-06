<?php

namespace App\Repositories\Backend\Supplier;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Auth\User;
use App\Models\Supplier\Supplier;
use App\Models\Item\Item;
use App\Models\Item\ItemOrder;

use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use App\Events\Backend\Supplier\SupplierCreated;
use App\Events\Backend\Supplier\SupplierUpdated;
use App\Events\Backend\Supplier\SupplierRestored;
use App\Events\Backend\Supplier\SupplierPermanentlyDeleted;

/**
 * Class SupplierRepository.
 */
class SupplierRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Supplier::class;
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
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getProductsPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $supplier_id) : LengthAwarePaginator
    {
        return Item::whereSupplierId($supplier_id)
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
    public function getItemOrderPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', $supplier_id) : LengthAwarePaginator
    {
        return ItemOrder::whereSupplierId($supplier_id)
            ->with(['item', 'supplier'])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Supplier
     */
    public function create(array $data) : Supplier
    {
        return DB::transaction(function () use ($data) {
            $supplier = parent::create([
                'name'                      => strtoupper($data['name']),
                'contact_person_first_name' => strtoupper($data['contact_person_first_name']),
                'contact_person_last_name'  => strtoupper($data['contact_person_last_name']),
                'email'                     => $data['email'],
                'mobile_number'             => $data['mobile_number'],
                'telephone_number'          => isset($data['telephone_number']) ? $data['telephone_number'] : 'N/A',
                'address'                   => strtoupper($data['address'])
            ]);

            if ($supplier) {
                event(new SupplierCreated($supplier));

                return $supplier;
            }

            throw new GeneralException(__('exceptions.backend.suppliers.create_error'));
        });
    }

    /**
     * @param Supplier  $supplier
     * @param array $data
     *
     * @return Supplier
     */
    public function update(Supplier $supplier, array $data) : Supplier
    {
        return DB::transaction(function () use ($supplier, $data) {
            if ($supplier->update([
                'name'                      => strtoupper($data['name']),
                'contact_person_first_name' => strtoupper($data['contact_person_first_name']),
                'contact_person_last_name'  => strtoupper($data['contact_person_last_name']),
                'email'                     => $data['email'],
                'mobile_number'             => $data['mobile_number'],
                'telephone_number'          => isset($data['telephone_number']) ? $data['telephone_number'] : 'N/A',
                'address'                   => strtoupper($data['address'])
            ]))

            {
                event(new SupplierUpdated($supplier));

                return $supplier;
            }

            throw new GeneralException(__('exceptions.backend.suppliers.update_error'));
        });
    }

    /**
     * @param User $supplier
     *
     * @return User
     * @throws GeneralException
     */
    public function forceDelete(Supplier $supplier) : Supplier
    {
        if (is_null($supplier->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.supplier.delete_first'));
        }

        return DB::transaction(function () use ($supplier) {

            if ($supplier->forceDelete()) {
                event(new SupplierPermanentlyDeleted($supplier));

                return $supplier;
            }

            throw new GeneralException(__('exceptions.backend.suppliers.delete_error'));
        });
    }

    /**
     * @param User $supplier
     *
     * @return User
     * @throws GeneralException
     */
    public function restore(Supplier $supplier) : Supplier
    {
        if (is_null($supplier->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.supplier.cant_restore'));
        }

        if ($supplier->restore()) {
            event(new SupplierRestored($supplier));

            return $supplier;
        }

        throw new GeneralException(__('exceptions.backend.supplier.restore_error'));
    }
}
