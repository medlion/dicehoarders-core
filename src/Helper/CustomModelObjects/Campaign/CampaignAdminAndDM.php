<?php


namespace App\Helper\CustomModelObjects\Campaign;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("NONE")
 */
class CampaignAdminAndDM
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $campaign_id;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $user_id;
}
