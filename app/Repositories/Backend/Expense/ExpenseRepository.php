<?php

namespace App\Repositories\Backend\Expense;

use App\Models\Accounts\Expense\Expense;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ExpenseRepository.
 */
class ExpenseRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Expense::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getExpensesPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
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
     * @return Expense
     */
    public function create(array $data) : Expense
    {
        return DB::transaction(function () use ($data) {
            $expense = parent::create([
                'code'          => $data['code'] != "" ? $data['code'] : "EXP-".date('Ymd'),
                'amount'        => str_replace(",", "", $data['amount']),
                'requested_by'  => $data['requested_by'],
                'user_id'       => Auth::user()->id,
                'cause'         => $data['cause']
            ]);

            if ($expense) {
                $expense->cashflow()->create(['amount' => $expense->amount]);

                return $expense;
            }

            throw new GeneralException(__('exceptions.backend.expenses.create_error'));
        });
    }

    /**
     * @param Expense  $expense
     * @param array $data
     *
     * @return Expense
     */
    public function update(Expense $expense, array $data) : Expense
    {
        return DB::transaction(function () use ($expense, $data) {
            if ($expense->update([
                'amount'        => str_replace(",", "", $data['amount']),
                'requested_by'  => $data['requested_by'],
                'user_id'       => Auth::user()->id,
                'cause'         => $data['cause']
            ])) {
                return $expense;
            }

            throw new GeneralException(__('exceptions.backend.expenses.update_error'));
        });
    }

    /**
     * @param Expense $expense
     *
     * @return Expense
     * @throws GeneralException
     */
    public function forceDelete(Expense $expense) : Expense
    {
        if (is_null($expense->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.expenses.delete_first'));
        }

        return DB::transaction(function () use ($expense) {
            if ($expense->forceDelete()) {
                return $expense;
            }

            throw new GeneralException(__('exceptions.backend.expenses.delete_error'));
        });
    }

    /**
     * @param Expense $expense
     *
     * @return Expense
     * @throws GeneralException
     */
    public function restore(Expense $expense) : Expense
    {
        if (is_null($expense->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.expenses.cant_restore'));
        }

        if ($expense->restore()) {
            return $expense;
        }

        throw new GeneralException(__('exceptions.backend.expenses.restore_error'));
    }
}
