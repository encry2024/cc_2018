<?php

namespace App\Http\Controllers\Backend\Item;

use App\Http\Requests\Backend\Supplier\ManageSupplierRequest;
use App\Models\Item\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Item\ManageItemRequest;
use App\Http\Requests\Backend\Item\StoreItemRequest;
use App\Http\Requests\Backend\Item\UpdateItemRequest;
use App\Repositories\Backend\Item\ItemRepository;
use App\Events\Backend\Item\ItemDeleted;
use App\Models\Supplier\Supplier;
use App\Models\Item\ItemCart;

class ItemController extends Controller
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     *}
     * @return \Illuminate\Http\Response
     */
    public function index(ManageSupplierRequest $manageSupplierRequest)
    {
        return view('backend.item.index')
            ->withItems($this->itemRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageSupplierRequest $manageSupplierRequest)
    {
        $suppliers = Supplier::all();

        return view('backend.item.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $storeItemRequest)
    {
        $this->itemRepository->create($storeItemRequest->only(
            'name',
            'supplier',
            'selling_price',
            'buying_price',
            'initial_weight',
            'final_weight'
        ));

        return redirect()->route('admin.item.index')->withFlashSuccess(__('alerts.backend.items.created', ['item' => strtoupper($storeItemRequest->name)]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item, ManageItemRequest $manageItemRequest)
    {
        return view('backend.item.show')->withItem($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item, ManageItemRequest $manageItemRequest)
    {
        $suppliers = Supplier::all();

        return view('backend.item.edit')->withItem($item)->withSuppliers($suppliers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Item $item, UpdateItemRequest $updateItemRequest)
    {
        $this->itemRepository->update($item, $updateItemRequest->only(
            'name',
            'supplier',
            'selling_price',
            'buying_price',
            'initial_weight',
            'final_weight'
        ));

        return redirect()->route('admin.item.index')->withFlashSuccess(__('alerts.backend.items.created', ['item' => $item->name]));
    }

    /**storeOrderedProducts
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item, ManageItemRequest $manageItemRequest)
    {
        $this->itemRepository->deleteById($item->id);

        event(new ItemDeleted($item));

        return redirect()->route('admin.item.deleted')->withFlashSuccess(__('alerts.backend.items.deleted', ['item' => $item->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function storeOrderedProducts(ManageItemRequest $request)
    {
        $this->itemRepository->storeOrderedProducts($request->only(
            'item_id',
            'quantity',
            'supplier_id'
        ));

        $item = Item::find($request->item_id);

        return \GuzzleHttp\json_encode($item);
    }

    public function getItemQueues(ManageItemRequest $request)
    {
        $item_queues = ItemCart::with(['item', 'supplier'])->groupBy('supplier_id')->limit(10)->get() ;

        dd($item_queues);
    }
}
