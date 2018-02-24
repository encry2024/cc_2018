<?php

namespace App\Http\Controllers\Backend\Item;

use App\Models\Item\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item\ItemCart;
use App\Http\Requests\Backend\Item\ManageItemRequest;

class ItemOrderController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCart $itemOrder, ManageItemRequest $request)
    {
        $order = $itemOrder->item->name;

        $itemOrder->delete();

        return redirect()->back()->withFlashSuccess("Your order '" . $order . "' was successfully deleted.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function confirmOrders(ManageItemRequest $request)
    {
        dd($request->all());
    }
}
