<?php


namespace App\Controller\User;


use App\Manager\User\UserAPIManager;
use App\Manager\User\UserManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Character\Character;

/**
* @Rest\Route("/api/user")
* @SWG\Tag(name="User")
*/
class UserController extends AbstractController
{

    /**
     * @Rest\Route(
     *     "/get-characters",
     *     name="get_user_characters",
     *     methods={"GET"},
     *     format="JSON"
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="Returns active characters for user",
     *     @Model(type=Character::class, groups={"characterlisting"})
     * )
     *
     * @param UserManager $userManager
     * @param UserAPIManager $userAPIManager
     * @return Response
     */
    public function getUserCharactersAction (UserManager $userManager, UserAPIManager $userAPIManager)
    {
        return $userAPIManager->userCharactersResponse($userManager->getUserCharacters($this->getUser()));
    }
}