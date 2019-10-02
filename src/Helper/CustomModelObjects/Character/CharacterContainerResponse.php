<?php


namespace App\Helper\CustomModelObjects\Character;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("NONE")
 */
class CharacterContainerResponse
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $character_item_id;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $item_name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $container_holding_item_item_type;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $current_item_holding_weight;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $item_holding_weight;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $current_item_holding_count;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $item_holding_count;
}
