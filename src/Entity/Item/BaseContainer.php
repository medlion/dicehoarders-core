<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Table(name="base_container")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class BaseContainer
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue()
     * @Serializer\Exclude()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Serializer\Exclude()
     */
    private $baseItemName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="weight_on_character", type="string")
     */
    private $weightOnCharacter;

    /**
     * @var int
     *
     * @ORM\Column(name="maximum_weight_pounds", type="integer")
     */
    private $maximumWeightPounds;

    /**
     * @var string
     *
     * @ORM\Column(name="hold_specific_base_item", type="string")
     */
    private $holdSpecificBaseItem;

    /**
     * @var boolean
     *
     * @ORM\Column(name="carried_on_person", type="boolean")
     */
    private $carriedOnPerson;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBaseItemName()
    {
        return $this->baseItemName;
    }

    /**
     * @param string $baseItemName
     */
    public function setBaseItemName($baseItemName)
    {
        $this->baseItemName = $baseItemName;
    }

    /**
     * @return bool
     */
    public function isWeightOnCharacter()
    {
        return $this->weightOnCharacter;
    }

    /**
     * @param bool $weightOnCharacter
     */
    public function setWeightOnCharacter($weightOnCharacter)
    {
        $this->weightOnCharacter = $weightOnCharacter;
    }

    /**
     * @return int
     */
    public function getMaximumWeightPounds()
    {
        return $this->maximumWeightPounds;
    }

    /**
     * @param int $maximumWeightPounds
     */
    public function setMaximumWeightPounds($maximumWeightPounds)
    {
        $this->maximumWeightPounds = $maximumWeightPounds;
    }

    /**
     * @return string
     */
    public function getHoldSpecificBaseItem()
    {
        return $this->holdSpecificBaseItem;
    }

    /**
     * @param string $holdSpecificBaseItem
     */
    public function setHoldSpecificBaseItem($holdSpecificBaseItem)
    {
        $this->holdSpecificBaseItem = $holdSpecificBaseItem;
    }

    /**
     * @return bool
     */
    public function isCarriedOnPerson()
    {
        return $this->carriedOnPerson;
    }

    /**
     * @param bool $carriedOnPerson
     */
    public function setCarriedOnPerson($carriedOnPerson)
    {
        $this->carriedOnPerson = $carriedOnPerson;
    }


}
