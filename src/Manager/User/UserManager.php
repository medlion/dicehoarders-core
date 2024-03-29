<?php


namespace App\Manager\User;


use App\Entity\Character\Character;
use App\Entity\User\SfUser;
use App\ExceptionHandling\UserFriendlyException;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface, EntityManagerInterface $entityManager, JWTTokenManagerInterface $JWTTokenManagerInterface, ValidatorInterface $validator)
    {
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
        $this->entityManager = $entityManager;
        $this->JWTTokenManagerInterface = $JWTTokenManagerInterface;
        $this->validator = $validator;
    }

    /**
     * @param $email
     * @param $username
     * @param $plaintextPassword
     * @return SfUser
     * @throws UserFriendlyException
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


    public function userMayCreateCharacters (SfUser $sfUser)
    {
        /** TODO Add functionality to check whether a user may create characters */
        return true;
    }

    /**
     * @param SfUser $user
     * @return Character[]
     */
    public function getUserCharacters (SfUser $user)
    {
        return $this->entityManager->getRepository(Character::class)->findBy(['user' => $user, 'status' => 1]);
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
        $emailConstraint = new Assert\Email();
        // all constraint "options" can be set this way
        $emailConstraint->message = 'Invalid email address';

        // use the validator to validate the value
        $errors = $this->validator->validate(
            $email,
            $emailConstraint
        );

        if (0 === count($errors)) {
            return true;
        }
        return false;
    }
}
