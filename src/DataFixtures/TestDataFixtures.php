<?php


namespace App\DataFixtures;


use App\Entity\User\SfUser;
use App\Manager\User\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TestDataFixtures extends Fixture implements FixtureGroupInterface
{

    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['dev_environment_data'];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \App\ExceptionHandling\UserFriendlyException
     */
    public function load(ObjectManager $manager)
    {
        $this->userManager->createUser('admin@dicehoarders', 'admin', 'password');
        $this->userManager->createUser('user@dicehoarders', 'user', 'password');
    }
}