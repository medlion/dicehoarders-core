<?php


namespace App\Controller\Campaign;


use App\ExceptionHandling\UserFriendlyException;
use App\Manager\Campaign\CampaignAPIManager;
use App\Manager\Campaign\CampaignManager;
use App\Manager\User\UserManager;
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

        return $campaignAPIManager->campaignResponse($campaignManager->createCampaign($content['name'], $user));
    }
}
