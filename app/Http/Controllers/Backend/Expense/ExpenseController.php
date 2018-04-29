<?php

namespace App\Http\Controllers\Backend\Expense;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Backend\Expense\ManageExpenseRequest;
use App\Http\Requests\Backend\Expense\StoreExpenseRequest;
use App\Http\Requests\Backend\Expense\EditExpenseRequest;
use App\Http\Requests\Backend\Expense\UpdateExpenseRequest;
use App\Http\Requests\Backend\Expense\DeleteExpenseRequest;

use App\Repositories\Backend\Expense\ExpenseRepository;
use App\Http\Requests\Backend\Expense\CreateExpenseRequest;
use App\Models\Accounts\Expense\Expense;

class ExpenseController extends Controller
{
    protected $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageExpenseRequest $request)
    {
        return view('backend.expense.index')
            ->withExpenses($this->expenseRepository->getExpensesPaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageExpenseRequest $request)
    {
        return view('backend.expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseRequest $request)
    {
        $expense = $this->expenseRepository->create($request->only(
            'code',
            'cause',
            'amount',
            'requested_by'
        ));

        return redirect()->back()->withFlashSuccess("You have successfully created Expense Code: ".$expense->code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense, ManageExpenseRequest $request)
    {
        return view('backend.expense.show')->withModel($expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense, ManageExpenseRequest $request)
    {
        return view('backend.expense.edit')->withExpense($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense = $this->expenseRepository->udpate($expense, $request->onyl(
            'code',
            'amount',
            'requested_by',
            'cause'
        ));

        return redirect()->back()->withFlashSuccess("You have successfully updated Expense Code: ".$expense->code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense, DeleteExpenseRequest $request)
    {
        $this->expenseRepository->deleteById($expense->id);

        return redirect()->route('admin.expense.index')->withFlashSuccess(__('alerts.backend.expenses.deleted', ['expense' => $expense->code]));
    }
}
