<?php


namespace App\Manager;


use App\Entity\SfUser;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoderInterface;

    public function createUser ($email, $username, $plaintextPassword)
    {
        $user = new SfUser();
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setPassword($this->userPasswordEncoderInterface->encodePassword($user, $plaintextPassword));
        $user->setRoles(['ROLE_USER']);
        $user->setValidated(false);

        $this->getObjectManager()->persist($user);
        $this->getObjectManager()->flush();

        return $user;
    }


    /**
     * @return ObjectManager
     */
    protected function getObjectManager ()
    {
        return $this->getDoctrine()->getManager();
    }
}