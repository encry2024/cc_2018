<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Customer\CustomerRepository;
use App\Http\Requests\Backend\Customer\ManageCustomerRequest;

/**
 * Class CustomerStatusController.
 */
class CustomerStatusController extends Controller
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param ManageCustomerRequest $manageCustomerRequest
     *
     * @return mixed
     */
    public function getDeleted(ManageCustomerRequest $manageCustomerRequest)
    {
        return view('backend.customer.deleted')
            ->withCustomers($this->customerRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Customer              $deletedCustomer
     * @param ManageCustomerRequest $manageCustomerRequest
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Customer $deletedCustomer, ManageCustomerRequest $manageCustomerRequest)
    {
        $customer_name = $deletedCustomer->name;

        $this->customerRepository->forceDelete($deletedCustomer);

        return redirect()->route('admin.customer.deleted')->withFlashSuccess(__('alerts.backend.customers.deleted_permanently', ['customer' => $customer_name]));
    }

    /**
     * @param Customer              $deletedCustomer
     * @param ManageCustomerRequest $manageCustomerRequest
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(Customer $deletedCustomer, ManageCustomerRequest $manageCustomerRequest)
    {
        $this->customerRepository->restore($deletedCustomer);

        return redirect()->route('admin.customer.index')->withFlashSuccess(__('alerts.backend.customers.restored', ['customer' => $deletedCustomer->name]));
    }
}