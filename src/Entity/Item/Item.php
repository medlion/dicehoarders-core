<?php


namespace App\Entity\Item;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

use App\Entity\Item\Armor;
use App\Entity\Item\ItemOverride;

/**
 * @ORM\Table(name="item")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="integer")
 * @ORM\DiscriminatorMap({
 *             "Item",
 *              1 = "Armor"
 * })
 * @Serializer\Discriminator(disabled=true)
 */
abstract class Item
{
    const ITEM_TYPE_MAP = [
        'Item',
        1 => 'Armor'
    ];

    /**
     * @var string
     * @Serializer\Expose()
     */
    protected $type;

    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Serializer\Expose()
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     * @Serializer\Expose()
     */
    private $description;


    /**
     * @var string
     *
     * @ORM\Column(name="physical_description", type="string")
     * @Serializer\Expose()
     */
    private $physicalDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string")
     */
    private $source;

    /**
     * @var int
     * @Serializer\Expose()
     */
    private $costCopper;

    /**
     * @var float
     * @Serializer\Expose()
     */
    private $weightPounds;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity=ItemOverride::class, mappedBy="itemId", fetch="EAGER")
     * @Serializer\Accessor(getter="getItemOverrides", setter="setItemOverrides")
     */
    private $itemOverrides;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCostCopper()
    {
        //return $this->loadValue('getCostCopper', self::COST_COPPER_OVERRIDE, 0);
        return $this->costCopper;
    }

    /**
     * @param int $costCopper
     */
    public function setCostCopper(int $costCopper)
    {
        $this->costCopper = $costCopper;
    }

    /**
     * @return float
     */
    public function getWeightPounds()
    {
        //return $this->loadValue('getWeightPounds', self::WEIGHT_POUNDS_OVERRIDE, 0.00);
        return $this->weightPounds;
    }

    /**
     * @param float $weightPounds
     */
    public function setWeightPounds(float $weightPounds)
    {
        $this->weightPounds = $weightPounds;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhysicalDescription()
    {
        return $this->physicalDescription;
    }

    /**
     * @param string $physicalDescription
     */
    public function setPhysicalDescription(string $physicalDescription)
    {
        $this->physicalDescription = $physicalDescription;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return ArrayCollection|null
     */
    public function getItemOverrides()
    {
        if (empty($this->itemOverrides)) {
            return null;
        }
        return $this->itemOverrides;
    }

    /**
     * @param ArrayCollection $itemOverrides
     */
    public function setItemOverrides(ArrayCollection $itemOverrides): void
    {
        $this->itemOverrides = $itemOverrides;
    }

    /**
     * @deprecated
     *
     * This is a general method that loads values. Load order :
     * 1) DM overrides. This uses serialization magic to allow the DM to hide certain pieces of information from players (Not implemented)
     * 2) Item ability overrides, if applicable (Not implemented)
     * 3) Item type overrides (Not implemented)
     * 4) Item overrides
     * 5) Base item
     * 6) Default value supplied (null)
     *
     * @param $functionName
     * @param $key
     * @param null $default
     * @return |null
     */
    private function loadValue ($functionName, $key, $default = null)
    {
        if (method_exists($this->getBaseItem(), $functionName)) {
            $returnValue = call_user_func([$this->getBaseItem(), $functionName]);
        }

        if (isset($this->overrides[$key])) {
            $returnValue = $this->overrides[$key];
        }

        if (!empty($returnValue)) {
            return $returnValue;
        }
        return $default;
    }
}
