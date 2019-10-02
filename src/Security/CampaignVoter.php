<?php


namespace App\Security;


use App\Entity\Campaign\Campaign;
use App\Entity\User\SfUser;
use App\Manager\Campaign\CampaignManager;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CampaignVoter extends Voter
{

    const CAMPAIGN_DM = 'campaign_dm';
    const CAMPAIGN_ADMIN = 'campaign_admin';
    const CAMPAIGN_PLAYER = 'campaign_player';

    private $campaignManager;

    public function __construct(CampaignManager $campaignManager)
    {
        $this->campaignManager = $campaignManager;
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string|array $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (is_array($attribute)) {
            foreach ($attribute as $singleAttribute) {
                if (!$this->checkAttribute($singleAttribute)) {
                    return false;
                }
            }
        } elseif (!$this->checkAttribute($attribute)) {
            return false;
        }

        return true;
    }


    /**
     * @param $attribute
     * @return bool
     */
    private function checkAttribute ($attribute)
    {
        if (in_array($attribute, [self::CAMPAIGN_DM, self::CAMPAIGN_ADMIN, self::CAMPAIGN_PLAYER], true)) {
            return true;
        }
        return false;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param Campaign $subject
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        switch ($attribute) {
            case self::CAMPAIGN_DM:
                return $this->isDM($subject, $token->getUser());
                break;
            case self::CAMPAIGN_ADMIN:
                return $this->isAdmin($subject, $token->getUser());
                break;
            case self::CAMPAIGN_PLAYER:
                return $this->isPlayer($subject, $token->getUser());
                break;
        }
    }

    private function isDM (Campaign $campaign, SfUser $user)
    {
        if (in_array($user, $campaign->getDms(), true)) {
            return true;
        }
        return false;
    }

    private function isAdmin (Campaign $campaign, SfUser $user)
    {
        if (in_array($user, $campaign->getAdmins(), true)) {
            return true;
        }
        return false;
    }

    private function isPlayer (Campaign $campaign, SfUser $user)
    {
        return true;
        /**
         * TODO Implement this
         */
    }
}
