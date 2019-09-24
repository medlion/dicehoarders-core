<?php


namespace App\Manager\Character;


use App\Entity\Character\Character;
use App\Entity\User\SfUser;
use App\ExceptionHandling\UserFriendlyException;
use App\Manager\Campaign\CampaignManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CharacterManager
{
    const PC_STATUS_ACTIVE = 1;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CampaignManager
     */
    private $campaignManager;

    public function __construct(EntityManagerInterface $entityManager, CampaignManager $campaignManager)
    {
        $this->entityManager = $entityManager;
        $this->campaignManager = $campaignManager;
    }

    /**
     * @param $user
     * @param null $campaignJoinCode
     * @throws UserFriendlyException
     */
    public function createCharacter ($user, $campaignJoinCode = null)
    {
        $character = new Character();
        $character->setUser($user);
        $character->setStatus(self::PC_STATUS_ACTIVE);
        $this->entityManager->persist($character);
        $this->entityManager->flush();

        if (!is_null($campaignJoinCode)) {
            $this->campaignManager->addCharacterToCampaignByJoinCode($character, $campaignJoinCode);
        }

        return $character;
    }
}
