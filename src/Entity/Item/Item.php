<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use JMS\Serializer\Annotation as Serializer;

use App\Entity\Item\Armor;
use App\Entity\Item\ItemOverride;
use phpDocumentor\Reflection\Types\Array_;

/**
 * @ORM\Table(name="item")
 * @Serializer\ExclusionPolicy("ALL")
 * @ORM\Entity()
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="integer")
 * @ORM\DiscriminatorMap({
 *     "Item",
 *     1 = "Armor"
 * })
 * @Serializer\Discriminator(disabled=true)
 */
abstract class Item
{
    const COST_COPPER_OVERRIDE = 'cost_copper';
    const WEIGHT_POUNDS_OVERRIDE = 'weight_pounds';

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
     */
    private $description;


    /**
     * @var string
     *
     * @ORM\Column(name="physical_description", type="string")
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
     * @var PersistentCollection
     *
     * @ORM\OneToMany(targetEntity=ItemOverride::class, mappedBy="itemId", fetch="EAGER")
     */
    private $itemOverrides;

    /**
     * @var array
     */
    private $overrides = [];

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
        return $this->loadValue('getCostCopper', self::COST_COPPER_OVERRIDE, 0);
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
        return $this->loadValue('getWeightPounds', self::WEIGHT_POUNDS_OVERRIDE, 0.00);
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




    abstract function getBaseItem ();


    /**
     * @Serializer\PreSerialize()
     */
    private function onPreSerialization () {
        $this->itemOverrides = $this->itemOverrides->getValues();
        $this->mapOverrides();

        $this->setCostCopper($this->getCostCopper());
        $this->setWeightPounds($this->getWeightPounds());
    }

    /**
     * This is a general method that loads values. Load order :
     * 1) DM overrides. This uses serialization magic to allow the DM to hide certain pieces of information from players
     * 2) Item ability overrides, if applicable
     * 3) Item type overrides
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
            $returnValue = $this->getBaseItem()->getCostCopper();
        }

        if (isset($this->overrides[$key])) {
            $returnValue = $this->overrides[$key];
        }

        if (!empty($returnValue)) {
            return $returnValue;
        }
        return $default;
    }

    private function findOverride ($key) {
    }

    private function mapOverrides ()
    {
        foreach ($this->itemOverrides as $itemOverride) {
            $this->overrides [$itemOverride->getOverrideKey()] = $itemOverride = $itemOverride->getValue();
        }
    }
}
