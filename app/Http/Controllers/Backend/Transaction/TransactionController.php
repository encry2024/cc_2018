<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Http\Requests\Backend\Auth\General\ManageAllRequestsForAdmin;
use App\Http\Requests\Backend\Transaction\StoreTransactionRequest;
use App\Http\Requests\Backend\Transaction\StoreItemTransactionRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Transaction\ManageTransactionRequest;
use App\Repositories\Backend\Transaction\TransactionRepository;
use App\Repositories\Backend\Item\ItemRepository;
use App\Events\Backend\Transaction\TransactionDeleted;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\ItemTransaction;

class TransactionController extends Controller
{
    protected $transactionRepository;
    protected $itemRepository;

    public function __construct(TransactionRepository $transactionRepository, ItemRepository $itemRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->itemRepository        = $itemRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageTransactionRequest $request)
    {
        return view('backend.transaction.index')
            ->withTransactions($this->transactionRepository->getPendingPaginated('25', 'id', 'desc', 'PENDING'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageTransactionRequest $request)
    {
        return view('backend.transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->transactionRepository->create($request->only(
            'item_order_id'
        ));

        return redirect()->route('admin.transaction.index')->withFlashSuccess(__('alerts.backend.transactions.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction, ManageAllRequestsForAdmin $request)
    {
        // dd($transaction->item_transactions);
        return view('backend.transaction.show')->withTransaction($transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
