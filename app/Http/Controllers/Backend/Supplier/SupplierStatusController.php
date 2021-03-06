<?php

namespace App\Http\Controllers\Backend\Supplier;

use App\Models\Supplier\Supplier;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Supplier\SupplierRepository;
use App\Http\Requests\Backend\Supplier\ManageSupplierRequest;
use App\Http\Requests\Backend\Supplier\RestoreSupplierRequest;
use App\Http\Requests\Backend\Supplier\ForceDeleteSupplierRequest;
/**
 * Class SupplierStatusController.
 */
class SupplierStatusController extends Controller
{
    /**
     * @var SupplierRepository
     */
    protected $supplierRepository;

    /**
     * @param SupplierRepository $supplierRepository
     */
    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @param ManageSupplierRequest $manageSupplierRequest
     *
     * @return mixed
     */
    public function getDeleted(ManageSupplierRequest $manageSupplierRequest)
    {
        return view('backend.supplier.deleted')
            ->withSuppliers($this->supplierRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Supplier                   $deletedSupplier
     * @param ForceDeleteSupplierRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Supplier $deletedSupplier, ForceDeleteSupplierRequest $request)
    {
        $this->supplierRepository->forceDelete($deletedSupplier);

        return redirect()->route('admin.supplier.deleted')->withFlashSuccess(__('alerts.backend.suppliers.deleted_permanently'));
    }

    /**
     * @param Supplier               $deletedSupplier
     * @param RestoreSupplierRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(Supplier $deletedSupplier, RestoreSupplierRequest $request)
    {
        $this->supplierRepository->restore($deletedSupplier);

        return redirect()->route('admin.supplier.index')->withFlashSuccess(__('alerts.backend.suppliers.restored', ['supplier' => $deletedSupplier->name]));
    }
}
