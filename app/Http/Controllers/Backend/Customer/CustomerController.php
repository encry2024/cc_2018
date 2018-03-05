<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
# Events
use App\Events\Backend\Customer\CustomerDeleted;
# Models
use App\Models\Customer\Customer;
use App\Models\Supplier\Supplier;
# Requests
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Supplier\ManageSupplierRequest;
use App\Http\Requests\Backend\Customer\ManageCustomerRequest;
use App\Http\Requests\Backend\Customer\StoreCustomerRequest;
use App\Http\Requests\Backend\Customer\UpdateCustomerRequest;
use App\Http\Requests\Backend\Customer\DeleteCustomerRequest;
# Repositories
use App\Repositories\Backend\Customer\CustomerRepository;
use App\Repositories\Backend\Item\ItemRepository;

class CustomerController extends Controller
{
    protected $customerRepository;
    protected $itemRepository;

    public function __construct(CustomerRepository $customerRepository, ItemRepository $itemRepository)
    {
        $this->customerRepository   = $customerRepository;
        $this->itemRepository       = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageSupplierRequest $manageSupplierRequest)
    {
        return view('backend.customer.index')
            ->withCustomers($this->customerRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageSupplierRequest $manageSupplierRequest)
    {
        $suppliers = Supplier::all();

        return view('backend.customer.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $storeCustomerRequest)
    {
        $this->customerRepository->create($storeCustomerRequest->only(
            'name',
            'email',
            'contact_number',
            'address',
            'discount',
            'credit_limit'
        ));

        return redirect()->route('admin.customer.index')->withFlashSuccess(__('alerts.backend.customers.created', ['customer' => strtoupper($storeCustomerRequest->name)]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer, ManageCustomerRequest $manageCustomerRequest)
    {
        return view('backend.customer.show')->withCustomer($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer, ManageCustomerRequest $manageCustomerRequest)
    {
        return view('backend.customer.edit')->withCustomer($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Customer $customer, UpdateCustomerRequest $updateCustomerRequest)
    {
        $this->customerRepository->update($customer, $updateCustomerRequest->only(
            'name',
            'email',
            'contact_number',
            'address',
            'discount',
            'credit_limit'
        ));

        return redirect()->route('admin.customer.index')->withFlashSuccess(__('alerts.backend.customers.created', ['customer' => $customer->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer, ManageCustomerRequest $manageCustomerRequest)
    {
        $this->customerRepository->deleteById($customer->id);

        event(new CustomerDeleted($customer));

        return redirect()->route('admin.customer.deleted')->withFlashSuccess(__('alerts.backend.customers.deleted', ['customer' => $customer->name]));
    }

    public function order(Customer $customer, ManageSupplierRequest $request)
    {
        return view('backend.customer.order')->withCustomer($customer)->withItems($this->itemRepository->getStocksPaginated());
    }
}
