<?php


namespace App\Manager\Campaign;


use App\Entity\Campaign\Campaign;
use App\Entity\User\SfUser;
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
        $this->entityManager->persist($campaign);
        $this->entityManager->flush();
        return $campaign;
    }

    /**
     * @return string
     */
    private function generateCampaignJoinCode ()
    {
        $permitted_chars = '0123456789BCDFGHJKLMNOPRSTVWXYZ0123456789BCDFGHJKLMNOPRSTVWXYZ0123456789BCDFGHJKLMNOPRSTVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 12);
    }
}
