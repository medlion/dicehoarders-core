<?php


namespace App\Controller\Admin;


use App\Manager\Item\ItemAPIManager;
use App\Manager\Item\ItemManager;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/admin")
 */
class AdminController
{
    /**
     * @Route(
     *     "/all-items",
     *      name="admin_get_all_items",
     *     methods={"GET"}
     * )
     */
    public function getAllItemsAction (ItemManager $itemManager, ItemAPIManager $itemAPIManager)
    {
        $items = $itemManager->getAllItems();

        return $itemAPIManager->allItemsResponse($items);
    }
}
