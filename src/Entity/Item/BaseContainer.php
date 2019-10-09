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
     * @var int
     *
     * @ORM\Column(name="cost_copper", type="integer")
     */
    protected $costCopper;

    /**
     * @var float
     *
     * @ORM\Column(name="weight_pounds", type="float")
     */
    protected $weightPounds;

    /**
     * @var boolean
     *
     * @ORM\Column(name="weight_on_character", type="string")
     */
    protected $weightOnCharacter;

    /**
     * @var int
     *
     * @ORM\Column(name="maximum_weight_pounds", type="integer")
     */
    protected $maximumWeightPounds;

    /**
     * @var string
     *
     * @ORM\Column(name="hold_specific_base_item", type="string")
     */
    protected $holdSpecificBaseItem;


    /**
     * @var int
     *
     * @ORM\Column(name="maximum_number", type="integer")
     */
    protected $maximumSpecificItemNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="carried_on_person", type="boolean")
     */
    protected $carriedOnPerson;

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
     * @return bool
     */
    public function isWeightOnCharacter()
    {
        return $this->weightOnCharacter;
    }

    /**
     * @return int|null
     */
    public function getMaximumWeightPounds()
    {
        return $this->maximumWeightPounds;
    }

    /**
     * @return string|null
     */
    public function getHoldSpecificBaseItem()
    {
        return $this->holdSpecificBaseItem;
    }

    /**
     * @return bool
     */
    public function isCarriedOnPerson()
    {
        return $this->carriedOnPerson;
    }

    /**
     * @return int
     */
    public function getCostCopper()
    {
        return $this->costCopper;
    }

    /**
     * @return float
     */
    public function getWeightPounds(): float
    {
        return $this->weightPounds;
    }

    /**
     * @return int|null
     */
    public function getMaximumSpecificItemNumber()
    {
        return $this->maximumSpecificItemNumber;
    }

    /**
     * @param int $maximumSpecificItemNumber
     */
    public function setMaximumSpecificItemNumber(int $maximumSpecificItemNumber): void
    {
        $this->maximumSpecificItemNumber = $maximumSpecificItemNumber;
    }



}
