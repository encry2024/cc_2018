<?php

namespace App\Http\Controllers\Backend\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Supplier\ManageSupplierRequest;
use App\Http\Requests\Backend\Supplier\StoreSupplierRequest;
use App\Http\Requests\Backend\Supplier\UpdateSupplierRequest;

use App\Repositories\Backend\Supplier\SupplierRepository;
use App\Repositories\Backend\Cart\CartRepository;

use App\Models\Supplier\Supplier;
use App\Events\Backend\Supplier\SupplierDeleted;
use App\Models\Cart\Cart;

class SupplierController extends Controller
{
    protected $supplierRepository;
    protected $cartRepository;

    public function __construct(SupplierRepository $supplierRepository, CartRepository $cartRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->cartRepository     = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageSupplierRequest $manageSupplierRequest)
    {
        return view('backend.supplier.index')
            ->withSuppliers($this->supplierRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageSupplierRequest $manageSupplierRequest
     * @return \Illuminate\Http\Response
     */
    public function create(ManageSupplierRequest $manageSupplierRequest)
    {
        return view('backend.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSupplierRequest  $storeSupplierRequest
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $storeSupplierRequest)
    {
        $this->supplierRepository->create($storeSupplierRequest->only(
            'name',
            'contact_person_first_name',
            'contact_person_last_name',
            'email',
            'mobile_number',
            'telephone_number',
            'address'
        ));

        return redirect()->back()
            ->withFlashSuccess(
                __(
                    'alerts.backend.suppliers.created', 
                    ['supplier' => strtoupper($storeSupplierRequest->name)]
                )
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier, ManageSupplierRequest $manageSupplierRequest)
    {
        return view('backend.supplier.show')
            ->withSupplier($supplier)
            ->withProducts($this->supplierRepository->getProductsPaginated(25, 'created_at', 'desc', $supplier->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier, ManageSupplierRequest $manageSupplierRequest)
    {
        return view('backend.supplier.edit')
            ->withSupplier($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSupplierRequest  $updateSupplierRequest
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Supplier $supplier, UpdateSupplierRequest $updateSupplierRequest)
    {
        $this->supplierRepository->update($supplier, $updateSupplierRequest->only(
            'name',
            'contact_person_first_name',
            'contact_person_last_name',
            'email',
            'address',
            'mobile_number',
            'telephone_number'
        ));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.suppliers.updated', ['supplier' => $supplier->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier, ManageSupplierRequest $manageSupplierRequest)
    {
        $this->supplierRepository->deleteById($supplier->id);

        event(new SupplierDeleted($supplier));

        return redirect()->route('admin.supplier.deleted')->withFlashSuccess(__('alerts.backend.suppliers.deleted', ['supplier' => $supplier->name]));
    }

    /**
     * Remove the specified resource from storage.
     *confirmCart
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function showCart(Supplier $supplier, ManageSupplierRequest $request)
    {
        return view('backend.supplier.cart')
            ->withSupplier($supplier)
            ->withQueues($this->cartRepository->getQueuesPaginated(25, 'created_at', 'desc', 'QUEUE', $supplier->id));
    }

    public function getSupplierQueuesCount()
    {
        return json_encode(Cart::where('status', 'QUEUE')->groupBy('supplier_id')->get()->count());
    }
}
