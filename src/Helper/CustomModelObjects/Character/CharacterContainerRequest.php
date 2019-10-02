<?php


namespace App\Helper\CustomModelObjects\Character;


use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("NONE")
 */
class CharacterContainerRequest
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
}
