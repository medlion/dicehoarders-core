<?php


namespace App\Controller\Character;

use App\ExceptionHandling\UserFriendlyException;
use App\Manager\Character\CharacterAPIManager;
use App\Manager\Character\CharacterManager;
use App\Manager\Item\ItemManager;
use App\Security\CampaignVoter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Character\Character;

use App\Entity\Item\Item;
use App\Entity\Item\Armor;
use App\Entity\Item\Container;
use App\Entity\Item\Ammunition;

/**
 * @Rest\Route("/api/character")
 * @SWG\Tag(name="Character")
 */
class CharacterController extends AbstractController
{
    /**
     * @Rest\Route(
     *      "/create",
     *     name="post_create_character",
     *     methods={"POST"},
     *     format="JSON"
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="Character created successfully",
     *     @Model(type=Character::class, groups={"characterlisting"})
     * )
     *
     * @param CharacterManager $characterManager
     * @param CharacterAPIManager $characterAPIManager
     * @param Request $request
     * @return JsonResponse
     * @throws UserFriendlyException
     */
    public function createCharacterAction (CharacterManager $characterManager, CharacterAPIManager $characterAPIManager, Request $request)
    {
        $user = $this->getUser();

        $campaignCode = null;
        $content = json_decode($request->getContent(), true);
        if (isset($content['join_code'])) {
            $campaignCode = $content['join_code'];
        }

        return $characterAPIManager->characterResponse($characterManager->createCharacter($user, $campaignCode));
    }

    /**
     * @Rest\Route(
     *     "/get-character-holding-items",
     *     name="get_get_character_holding_items",
     *     methods={"GET"},
     *     format="JSON"
     * )
     *
     * @SWG\Parameter(
     *     name="character_item",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type="App\Helper\CustomModelObjects\Character\CharacterContainerRequest"))
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="All containers belonging to character, optionally whether only for certain item",
     *     @Model(type="App\Helper\CustomModelObjects\Character\CharacterContainerResponse")
     * )
     *
     * @param CharacterManager $characterManager
     * @param ItemManager $itemManager
     * @param Request $request
     * @return JsonResponse
     * @throws UserFriendlyException
     * @throws \Exception
     */
    public function getHoldingItemsForCharacter (CharacterManager $characterManager, ItemManager $itemManager, Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $character = $characterManager->getCharacterById($content['character_id']);
        if (!$this->getUser() === $character->getUser()) {
            $this->denyAccessUnlessGranted(CampaignVoter::CAMPAIGN_DM, $character->getCampaign());
        }

        $item = null;
        if (isset($content['item_id'])) {
            $item = $itemManager->getItemById($content['item_id']);
        }
        $containers = $characterManager->getCharacterContainers($character, $item);

        return new JsonResponse($containers);
    }

    /**
     * @Rest\Route(
     *     "/get-all-items",
     *     name="get_all_items",
     *     methods={"GET"},
     *     format="JSON"
     * )
     *
     * @SWG\Parameter(
     *     name="character_item",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type="App\Helper\CustomModelObjects\Character\CharacterRequest"))
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="Array of all them items a character has in inventory (Base Item will be flattened in array)",
     *     @Model(type=Item::class)
     *
     * )
     *
     * @SWG\Response(
     *     response="201",
     *     description="Armor",
     *     @Model(type=Armor::class)
     * )
     *
     * @SWG\Response(
     *     response="202",
     *     description="Container",
     *     @Model(type=Container::class)
     * )
     *
     * @SWG\Response(
     *     response="203",
     *     description="Ammunition",
     *     @Model(type=Ammunition::class)
     * )
     *
     * @param CharacterManager $characterManager
     * @param CharacterAPIManager $characterAPIManager
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllCharacterItems (CharacterManager $characterManager, CharacterAPIManager $characterAPIManager, Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $character = $characterManager->getCharacterById($content['character_id']);
        if (!$this->getUser() === $character->getUser()) {
            $this->denyAccessUnlessGranted(CampaignVoter::CAMPAIGN_DM, $character->getCampaign());
        }

        return $characterAPIManager->jsonSerialize($characterManager->getAllCharacterItems($character));

    }

}
