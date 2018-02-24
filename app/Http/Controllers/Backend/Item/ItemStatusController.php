<?php

namespace App\Http\Controllers\Backend\Item;

use App\Models\Item\Item;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Item\ItemRepository;
use App\Http\Requests\Backend\Item\ManageItemRequest;

/**
 * Class ItemStatusController.
 */
class ItemStatusController extends Controller
{
    /**
     * @var ItemRepository
     */
    protected $itemRepository;

    /**
     * @param ItemRepository $itemRepository
     */
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param ManageItemRequest $manageItemRequest
     *
     * @return mixed
     */
    public function getDeleted(ManageItemRequest $manageItemRequest)
    {
        return view('backend.item.deleted')
            ->withItems($this->itemRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Item              $deletedItem
     * @param ManageItemRequest $manageItemRequest
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Item $deletedItem, ManageItemRequest $manageItemRequest)
    {
        $item_name = $deletedItem->name;

        $this->itemRepository->forceDelete($deletedItem);

        return redirect()->route('admin.item.deleted')->withFlashSuccess(__('alerts.backend.items.deleted_permanently', ['item' => $item_name]));
    }

    /**
     * @param Item              $deletedItem
     * @param ManageItemRequest $manageItemRequest
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(Item $deletedItem, ManageItemRequest $manageItemRequest)
    {
        $this->itemRepository->restore($deletedItem);

        return redirect()->route('admin.item.index')->withFlashSuccess(__('alerts.backend.items.restored', ['item' => $deletedItem->name]));
    }
}