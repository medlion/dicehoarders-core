<?php


namespace App\Manager\Campaign;


use App\Entity\Campaign\Campaign;
use App\Entity\Character\Character;
use App\Entity\User\SfUser;
use App\ExceptionHandling\UserFriendlyException;
use Doctrine\ORM\EntityManagerInterface;

class CampaignManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getDomainById ($id)
    {
        $campaign = $this->entityManager->getRepository(Campaign::class)->find($id);
        if ($campaign instanceof Campaign) {
            return $campaign;
        }
        throw new UserFriendlyException('Campaign not found');
    }


    /**
     * @param string $name
     * @param SfUser $user
     * @return Campaign
     */
    public function createCampaign ($name, $user)
    {
        $campaign = new Campaign();
        $campaign->setName($name);
        $campaign->setCreator($user);
        do {
            $code = $this->generateCampaignJoinCode();
        } while ($this->entityManager->getRepository(Campaign::class)->findBy(['joinCode' => $code]) instanceof Campaign);

        $campaign->setJoinCode($code);
        $campaign->setJoinUnlocked(true);
        $this->entityManager->persist($campaign);
        $this->entityManager->flush();
        return $campaign;
    }


    /**
     * @param Character $character
     * @param string $joinCode
     * @return Campaign
     * @throws UserFriendlyException
     */
    public function addCharacterToCampaignByJoinCode ($character, $joinCode)
    {
        $campaign = $this->entityManager->getRepository(Campaign::class)->findOneBy(['joinCode' => $joinCode]);
        if (!$campaign instanceof Campaign) {
            throw new UserFriendlyException('Invalid campaign join code');
        }
        if (!$campaign->isJoinUnlocked()) {
            throw new UserFriendlyException('Player characters can not be added to this campaign at this time');
        }

        $character->setCampaign($campaign);
        $this->entityManager->flush();

        return $campaign;
    }

    /**
     * @param Campaign $campaign
     * @param SfUser $user
     * @throws UserFriendlyException
     */
    public function addDMToCampaign ($campaign, $user)
    {
        $dms = $campaign->getDms();
        if (in_array($user, $dms, true)) {
            throw new UserFriendlyException('This user is already a DM for the campaign');
        }
        $dms [] = $user;
        $campaign->setDms($dms);
    }

    /**
     * TODO implement campaign join lock/unlock
     */

    /**
     * @return string
     */
    private function generateCampaignJoinCode ()
    {
        $permitted_chars = '0123456789BCDFGHJKLMNOPRSTVWXYZ0123456789BCDFGHJKLMNOPRSTVWXYZ0123456789BCDFGHJKLMNOPRSTVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 12);
    }

}
