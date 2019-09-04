<?php


namespace App\Controller;


use App\Entity\SfUser;
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
     * @throws \Exception
     */
    public function createUser (Request $request, UserPasswordEncoderInterface $encoder)
    {
        if (!empty($this->getUser())) {
            throw new \Exception('Can not create users while logged in');
        }

        $content = json_decode($request->getContent(), true);

        $user = new SfUser();
        $user->setEmail($content['email']);
        $user->setUsername($content['username']);
        $user->setPassword($encoder->encodePassword($user, $content['plaintext_password']));
        $user->setRoles(['ROLE_USER']);
        $user->setValidated(false);

        $this->getObjectManager()->persist($user);
        $this->getObjectManager()->flush();

        $response = new Response();
    }


    /**
     * @return ObjectManager
     */
    protected function getObjectManager ()
    {
        return $this->getDoctrine()->getManager();
    }
}