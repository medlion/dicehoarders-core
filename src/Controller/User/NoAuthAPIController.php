<?php


namespace App\Controller\User;


use App\ExceptionHandling\UserFriendlyException;
use App\Manager\User\UserAPIManager;
use App\Manager\User\UserManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use App\Entity\User\SfUser;

/**
 * @Route("/api/noauth")
 * @SWG\Tag(name="User")
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
     *     @Model(type=SfUser::Class, groups={"loginresponse"})
     * )
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

        return $userAPIManager->userLoggedInResponse($user);
    }


    /**
     * @Rest\Route(
     *     "/login-check",
     *     name="post_login_user",
     *     methods={"GET"},
     *     format="JSON"
     * )
     *
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=SfUser::Class, groups={"signuprequirement"})))
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="User logged in successfully",
     *     @Model(type=SfUser::Class, groups={"loginresponse"})
     * )
     *
     * @param Request $request
     * @param UserManager $userManager
     * @param UserAPIManager $userAPIManager
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws UserFriendlyException
     */
    public function loginCheckAction (Request $request, UserManager $userManager, UserAPIManager $userAPIManager)
    {
        $content = json_decode($request->getContent(), true);

        if (! empty ($content['username'])) {
            $loginKey = $content['username'];
        } elseif (! empty ($content['email'])) {
            $loginKey = $content['email'];
        } else {
            throw new UserFriendlyException('User not found');
        }

        $user = $userManager->authenticateUser($loginKey, $content['plaintext_password']);

        return $userAPIManager->userLoggedInResponse($user);
    }



}
