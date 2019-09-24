<?php


namespace App\Manager\User;


use App\Entity\User\SfUser;
use App\ExceptionHandling\UserFriendlyException;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoderInterface;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var JWTTokenManagerInterface
     */
    private $JWTTokenManagerInterface;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface, EntityManagerInterface $entityManager, JWTTokenManagerInterface $JWTTokenManagerInterface)
    {
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
        $this->entityManager = $entityManager;
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
        if (! $this->isValidEmail($email)) {
            throw new UserFriendlyException('Email address is invalid');
        }

        if (! $this->isValidUsername($username)) {
            throw new UserFriendlyException('Username is invalid');
        }

        if (! $this->getDetailsAvailability($username, $email)) {
            throw new UserFriendlyException('Accounts exists with supplied credentials');
        }

        $user = new SfUser();
        $user->setEmail($email);
        if ($this->isValidUsername($username)) {
            $user->setUsername($username);
        }
        $user->setPassword($this->userPasswordEncoderInterface->encodePassword($user, $plaintextPassword));
        $user->setRoles(['ROLE_USER']);
        $user->setValidatedAt(null);
        $user->setToken($this->JWTTokenManagerInterface->create($user));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

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
     * @return SfUser|object|null
     * @throws UserFriendlyException
     */
    public function authenticateUser ($loginKey, $plaintextPassword)
    {
        if (! strpos($loginKey, '@')) {
            $user = $this->entityManager->getRepository(SfUser::class)->findOneBy(['username' => $loginKey]);
        } else {
            $user = $this->entityManager->getRepository(SfUser::class)->findOneBy([ 'email' => $loginKey]);
        }

        if (is_null($user)) {
            throw new UserFriendlyException('Login credentials and password do not match');
        }

        if ($this->userPasswordEncoderInterface->isPasswordValid($user, $plaintextPassword)) {
            $user->setToken($this->getToken($user));
            return $user;
        }

        throw new UserFriendlyException('Login credentials and password do not match');
    }


    /**
     * @param string $username
     * @param string $email
     * @return bool
     */
    public function getDetailsAvailability ($username, $email)
    {
        /** TODO Add actual functionality */
        return true;
    }


    /**
     * @param SfUser $sfUser
     * @return bool
     */
    public function userMayCreateCampaign (SfUser $sfUser)
    {
        /** TODO Add actual functionality */
        return true;
    }

    /**
     * @param string $username
     * @return bool
     */
    protected function isValidUsername ($username)
    {
        /** TODO Add more functionality */
        if (!ctype_alnum($username))
        {
            return false;
        }

        return true;
    }

    /**
     * @param string $email
     * @return bool
     */
    protected function isValidEmail ($email)
    {
        /** TODO Add actual functionality */
        return true;
    }

    /**
     * @param int $userId
     * @return SfUser|object|null
     * @throws UserFriendlyException
     */
    public function getUserById (int $userId)
    {
        $user = $this->entityManager->getRepository(SfUser::class)->find($userId);
        if ($user instanceof SfUser) {
            return $user;
        }
        throw new UserFriendlyException('User not found');
    }
}
