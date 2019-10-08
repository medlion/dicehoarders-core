<?php


namespace App\Helper\CustomModelObjects\Character;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("NONE")
 */
class CharacterRequest
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $character_id;
}