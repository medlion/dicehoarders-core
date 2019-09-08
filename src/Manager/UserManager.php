<?php


namespace App\Manager;


use App\Entity\SfUser;
use Doctrine\Common\Persistence\ObjectManager;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoderInterface;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var JWTTokenManagerInterface
     */
    private $JWTTokenManagerInterface;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface, ObjectManager $objectManager, JWTTokenManagerInterface $JWTTokenManagerInterface)
    {
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
        $this->objectManager = $objectManager;
        $this->JWTTokenManagerInterface = $JWTTokenManagerInterface;
    }

    /**
     * @param $email
     * @param $username
     * @param $plaintextPassword
     * @return SfUser
     */
    public function createUser ($email, $username, $plaintextPassword)
    {
        $user = new SfUser();
        $user->setEmail($email);
        if ($this->isValidUsername($username)) {
            $user->setUsername($username);
        }
        $user->setPassword($this->userPasswordEncoderInterface->encodePassword($user, $plaintextPassword));
        $user->setRoles(['ROLE_USER']);
        $user->setValidatedAt(null);

        $this->getObjectManager()->persist($user);
        //$this->getObjectManager()->flush();

        return $user;
    }

    /**
     * @param SfUser $user
     * @return string
     */
    public function getToken ($user)
    {
        return $this->JWTTokenManagerInterface->create($user);
    }

    /**
     * Does a login auth check using either the username or password
     * Returns the user if successful
     *
     * @param $loginKey
     * @param $plaintextPassword
     * @return SfUser|object|void|null
     */
    public function authenticateUser ($loginKey, $plaintextPassword)
    {
        if ($this->isValidUsername($loginKey)) {
            $user = $this->getObjectManager()->getRepository(SfUser::class)->findOneBy(['username' => $loginKey]);
        } elseif (true) {
            $user = $this->getObjectManager()->getRepository(SfUser::class)->findOneBy([ 'email' => $loginKey]);
        }

        if (is_null($user)) {
            return;
        }

        if ($user->getPassword() === $this->userPasswordEncoderInterface->encodePassword($plaintextPassword)) {
            return $user;
        }

        return;
    }


    /**
     * @return ObjectManager
     */
    protected function getObjectManager ()
    {
        return $this->objectManager;
    }

    protected function isValidUsername ($username)
    {
        if (!ctype_alnum($username))
        {
            return false;
        }

        return true;
    }
}
