<?php


namespace App\Controller;


use App\Entity\SfUser;
use App\Manager\UserManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @param Request $request
     * @param UserManager $userManager
     * @return Response
     * @throws \Exception
     */
    public function createUser (Request $request, UserManager $userManager)
    {
        if (!empty($this->getUser())) {
            throw new \Exception('Can not create users while logged in');
        }

        $content = json_decode($request->getContent(), true);

        $userManager->createUser($content['email'], $content['username'], $content['plaintext_password']);

        return new Response();
    }



}