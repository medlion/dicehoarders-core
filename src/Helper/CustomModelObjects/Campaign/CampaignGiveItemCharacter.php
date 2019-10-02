<?php


namespace App\Helper\CustomModelObjects\Campaign;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("NONE")
 */
class CampaignGiveItemCharacter
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $character_id;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $item_id;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $holding_item_id;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $count;
}
