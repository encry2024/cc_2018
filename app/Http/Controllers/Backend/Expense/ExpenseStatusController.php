<?php

namespace App\Http\Controllers\Backend\Expense;

use App\Models\Accounts\Expense\Expense;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Expense\ExpenseRepository;
use App\Http\Requests\Backend\Expense\ManageExpenseRequest;
use App\Http\Requests\Backend\Expense\RestoreExpenseRequest;
use App\Http\Requests\Backend\Expense\ForceDeleteExpenseRequest;
/**
 * Class ExpenseStatusController.
 */
class ExpenseStatusController extends Controller
{
    /**
     * @var ExpenseRepository
     */
    protected $expenseRepository;

    /**
     * @param ExpenseRepository $expenseRepository
     */
    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * @param ManageExpenseRequest $manageExpenseRequest
     *
     * @return mixed
     */
    public function getDeleted(ManageExpenseRequest $manageExpenseRequest)
    {
        return view('backend.expense.deleted')
            ->withExpenses($this->expenseRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Expense                   $deletedExpense
     * @param ForceDeleteExpenseRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Expense $deletedExpense, ForceDeleteExpenseRequest $request)
    {
        $expense_name = $deletedExpense->name;

        $this->expenseRepository->forceDelete($deletedExpense);

        return redirect()->route('admin.expense.deleted')->withFlashSuccess(__('alerts.backend.expenses.deleted_permanently', ['expense' => $expense_name]));
    }

    /**
     * @param Expense               $deletedExpense
     * @param RestoreExpenseRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(Expense $deletedExpense, RestoreExpenseRequest $request)
    {
        $this->expenseRepository->restore($deletedExpense);

        return redirect()->route('admin.expense.index')->withFlashSuccess(__('alerts.backend.expenses.restored', ['expense' => $deletedExpense->name]));
    }
}