<?php


namespace App\Controller\Character;

use App\Manager\Character\CharacterAPIManager;
use App\Manager\Character\CharacterManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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
     * @param CharacterManager $characterManager
     * @return \App\Entity\Character\Character
     * @throws \App\ExceptionHandling\UserFriendlyException
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

}
