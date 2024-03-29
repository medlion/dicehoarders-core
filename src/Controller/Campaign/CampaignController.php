<?php


namespace App\Controller\Campaign;


use App\ExceptionHandling\UserFriendlyException;
use App\Manager\Campaign\CampaignAPIManager;
use App\Manager\Campaign\CampaignManager;
use App\Manager\Character\CharacterAPIManager;
use App\Manager\Character\CharacterManager;
use App\Manager\Item\ItemManager;
use App\Manager\User\UserManager;
use App\Security\CampaignVoter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Campaign\Campaign;

/**
 * @Rest\Route("/api/campaign")
 * @SWG\Tag(name="Campaign")
 */
class CampaignController extends AbstractController
{
    /**
     * @Rest\Route(
     *      "/create",
     *     name="post_create_campaign",
     *     methods={"POST"},
     *     format="JSON"
     * )
     *
     * @SWG\Parameter(
     *     name="campaign",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=Campaign::class, groups={"campaigncreationrequirement"}))
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="Campaign created successfully",
     *     @Model(type=Campaign::class, groups={"campaigndetailsresponse"})
     * )
     *
     * @param CampaignManager $campaignManager
     * @param UserManager $userManager
     * @param CampaignAPIManager $campaignAPIManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws UserFriendlyException
     */
    public function createCampaignAction (CampaignManager $campaignManager, UserManager $userManager, CampaignAPIManager $campaignAPIManager, Request $request)
    {
        $user = $this->getUser();
        $content = json_decode($request->getContent(), true);

        if (!$userManager->userMayCreateCampaign($user)) {
            throw new UserFriendlyException('This user may not create a campaign');
        }

        return $campaignAPIManager->campaignResponse($campaignManager->createCampaign($content['campaign_name'], $user));
    }

    /**
     * @Rest\Route(
     *     "/add-admin/",
     *     name="post_add_campaign_admin",
     *     methods={"POST"},
     *     format="JSON"
     * )
     *
     * @SWG\Parameter(
     *     name="campaign_admin",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type="App\Helper\CustomModelObjects\Campaign\CampaignAdminAndDM"))
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="User added as campaign admin successfully",
     *     @Model(type=Campaign::class, groups={"campaignadminsresponse"})
     * )
     *
     * @param CampaignManager $campaignManager
     * @param UserManager $userManager
     * @param CampaignAPIManager $campaignAPIManager
     * @param Request $request
     * @return CampaignController|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws UserFriendlyException
     */
    public function addAdminToCampaignAction (CampaignManager $campaignManager, UserManager $userManager, CampaignAPIManager $campaignAPIManager, Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $campaign = $campaignManager->getDomainById($content['campaign_id']);

        $this->denyAccessUnlessGranted(CampaignVoter::CAMPAIGN_ADMIN, $campaign);

        $user = $userManager->getUserById($content['user_id']);

        return $campaignAPIManager->campaignAdminResponse($campaignManager->addAdminToCampaign($campaign, $user));
    }


    /**
     * @Rest\Route(
     *     "/add-dm/",
     *     name="post_add_campaign_dm",
     *     methods={"POST"},
     *     format="JSON"
     * )
     *
     * @SWG\Parameter(
     *     name="campaign_admin",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type="App\Helper\CustomModelObjects\Campaign\CampaignAdminAndDM"))
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="User added as campaign DM successfully",
     *     @Model(type=Campaign::class, groups={"campaigndmresponse"})
     * )
     *
     * @param CampaignManager $campaignManager
     * @param UserManager $userManager
     * @param CampaignAPIManager $campaignAPIManager
     * @param Request $request
     * @return CampaignController|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws UserFriendlyException
     */
    public function addDMToCampaignAction (CampaignManager $campaignManager, UserManager $userManager, CampaignAPIManager $campaignAPIManager, Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $campaign = $campaignManager->getDomainById($content['campaign_id']);

        $this->denyAccessUnlessGranted(CampaignVoter::CAMPAIGN_ADMIN, $campaign);

        $user = $userManager->getUserById($content['user_id']);

        return $campaignAPIManager->campaignDMResponse($campaignManager->addDMToCampaign($campaign, $user));
    }


    /**
     * @Rest\Route(
     *     "/give-item-character",
     *     name="post_give_item_to_character",
     *     methods={"POST"},
     *     format="JSON"
     * )
     *
     * @SWG\Parameter(
     *     name="character_item",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type="App\Helper\CustomModelObjects\Campaign\CampaignGiveItemCharacter"))
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="Item given to character successfully",
     *     @Model(type="App\Entity\Character\CharacterItem")),
     * )
     *
     * @param ItemManager $itemManager
     * @param CharacterManager $characterManager
     * @param CharacterAPIManager $characterAPIManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws UserFriendlyException
     */
    public function giveItemToCharacterAsDM (ItemManager $itemManager, CharacterManager $characterManager, CharacterAPIManager $characterAPIManager, Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $character = $characterManager->getCharacterById($content['character_id']);
        $campaign = $character->getCampaign();

        $this->denyAccessUnlessGranted(CampaignVoter::CAMPAIGN_DM, $campaign);

        $item = $itemManager->getItemById($content['item_id']);
        $holdingItem = null;
        if (isset($content['holding_item_id'])) {
            $holdingItem = $itemManager->getItemById($content['holding_item_id']);
        }
        $count = null;
        if (isset($content['count'])) {
            $count = (int)$content['count'];
        }

        $characterItem = $characterManager->giveItemToCharacter($item, $character, $holdingItem, $count);
        return $characterAPIManager->campaignGiveCharacterItemResponse($characterItem);
    }
}
