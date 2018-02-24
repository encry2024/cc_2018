<?php

namespace App\Http\Controllers\Backend\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cart\Cart;
use App\Models\Item\Item;

use App\Repositories\Backend\Cart\CartRepository;

use App\Http\Requests\Backend\Auth\General\ManageAllRequestsForAdmin;

class CartController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
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
}
