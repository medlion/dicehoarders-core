<?php


namespace App\Controller\Admin;


use App\Entity\User\SfUser;
use App\Manager\Item\ItemAPIManager;
use App\Manager\Item\ItemManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route(
     *     "/all-items",
     *      name="admin_get_all_items",
     *     methods={"GET"}
     * )
     *
     * @param ItemManager $itemManager
     * @param ItemAPIManager $itemAPIManager
     * @return JsonResponse
     */
    public function getAllItemsAction (ItemManager $itemManager, ItemAPIManager $itemAPIManager)
    {
        $this->denyAccessUnlessGranted(SfUser::ROLE_ADMIN);

        $items = $itemManager->getAllItems();

        return $itemAPIManager->allItemsResponse($items);
    }
}
