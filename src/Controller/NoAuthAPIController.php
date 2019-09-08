<?php


namespace App\Controller;


use App\Manager\UserAPIManager;
use App\Manager\UserManager;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use App\Entity\SfUser;

/**
 * @Route("/api/noauth")
 */
class NoAuthAPIController extends AbstractController
{
    /**
     * @Route(
     *     "/create-user",
     *     name="post_create_user",
     *     methods={"POST"},
     *     format="JSON"
     * )
     *
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=SfUser::Class, groups={"signuprequirement"}))
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="User created successfully",
     *     @Model(type=SfUser::Class, groups={"signupresponse"})
     * )
     *
     * @SWG\Tag(name="User")
     *
     * @param Request $request
     * @param UserManager $userManager
     * @param UserAPIManager $userAPIManager
     * @return Response
     * @throws \Exception
     */
    public function createUserAction (Request $request, UserManager $userManager, UserAPIManager $userAPIManager)
    {
        if (!empty($this->getUser())) {
            throw new \Exception('Can not create users while logged in');
        }

        $content = json_decode($request->getContent(), true);

        $user = $userManager->createUser($content['email'], $content['username'], $content['plaintext_password']);

        return $userAPIManager->userSuccessfullyCreatedResponse($user);
    }

    public function loginCheckAction (Request $request, UserManager $userManager)
    {
        $content = json_decode($request->getContent(), true);

        if (! empty ($content['username'])) {
            $loginKey = $content['username'];
        } elseif (! empty ($content['email'])) {
            $loginKey = $content['email'];
        } else {
            return;
        }

        return $userManager->getToken($userManager->authenticateUser($loginKey, $content['plaintext_password']));
    }



}
