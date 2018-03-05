<?php

namespace App\Http\Controllers\Backend\Cart;

# Requests
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Auth\General\ManageAllRequestsForAdmin;
use App\Http\Requests\Backend\Cart\ManageCartRequest;
# Controllers
use App\Http\Controllers\Controller;
# Models
use App\Models\Cart\Cart;
use App\Models\Item\Item;
use App\Models\Supplier\Supplier;
# Repository
use App\Repositories\Backend\Cart\CartRepository;
use DB;

class CartController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function index(ManageAllRequestsForAdmin $request)
    {
        if(($request->has('name') && ($request->has('status')))) {
            return view('backend.cart.index')->withCarts($this->cartRepository->getQueuesPaginated('25', 'created_at', 'desc', $request->status, $request->name));
        }

        return view('backend.cart.index')->withCarts($this->cartRepository->getQueuesPaginated('25', 'created_at', 'desc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ManageAllRequestsForAdmin  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManageAllRequestsForAdmin $request)
    {
        $this->cartRepository->create($request->only(
            'item_id',
            'quantity',
            'supplier_id'
        ));

        $item = Item::find($request->item_id);

        return \GuzzleHttp\json_encode($item);
    }

    public function update(ManageCartRequest $request, Cart $cart)
    {
        $this->cartRepository->update($cart);

        if ($cart->status == "REQUESTED") {
            return redirect()->back()->withFlashSuccess("You have requested <strong>". $cart->quantity .' '. $cart->item->final_weight_type ."</strong> of '". $cart->item->name."' from supplier ". $cart->supplier->name .".");
        } elseif ($cart->status == "RECEIVED") {
            return redirect()->back()->withFlashSuccess("You have received ". $cart->quantity .' '. $cart->item->final_weight_type ." of '". $cart->item->name."' from supplier <strong>". $cart->supplier->name ."</strong>.");
        }
    }

    public function getCartQueues()
    {
        $cart_queues_count = DB::table('carts')
            ->leftJoin('suppliers', function($join) {
                $join->on('suppliers.id', '=', 'carts.supplier_id');
            })
            ->leftJoin('items', function($join) {
                $join->on('carts.item_id', '=', 'items.id');
            })
            ->select(DB::raw('COUNT(carts.supplier_id) as queued_item_per_supplier'), 'suppliers.name', 'suppliers.id', 'carts.supplier_id')
            ->groupBy('carts.supplier_id')
            ->where('status', 'QUEUE')
            ->get()->toJson();

        return $cart_queues_count;
    }
}
