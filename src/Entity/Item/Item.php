<?php


namespace App\Entity\Item;

use App\Helper\Tools;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

use App\Entity\Item\Armor;
use App\Entity\Item\Container;
use App\Entity\Item\Ammunition;
use App\Entity\Item\ItemOverride;
use ReflectionClass;
use ReflectionException;

/**
 * TODO Change the order of items
 *
 * Mainly, by following the order of items in the PHB
 * 1.1 Coinage
 * 1.2 Trade goods
 * 2 Armor
 * 3.1 Weapons
 * 3.2 Ammunition
 * 4 Adventuring goods
 */

/**
 * @ORM\Table(name="item")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="integer")
 * @ORM\DiscriminatorMap({
 *             "Item",
 *              1 = "Armor",
 *              2 = "Container",
 *              3 = "Ammunition",
 *              4 = "Coinage"
 * })
 * @Serializer\Discriminator(disabled=true)
 */
abstract class Item
{
    const SOURCE_SRD = 'SRD';

    const RARITY_MUNDANE = 'Mundane';
    const RARITY_COMMON = 'Common';
    const RARITY_UNCOMMON = 'Uncommon';
    const RARITY_RARE = 'Rare';
    const RARITY_VARY_RARE = 'Very Rare';
    const RARITY_LEGENDARY = 'Legendary';

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
     * TODO Add some validation on this
     *
     * @var string
     *
     * @ORM\Column(name="rarity", type="string")
     */
    private $rarity;

    /**
     * @var DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    /**
     * @var ItemOverride[]
     *
     * @ORM\OneToMany(targetEntity=ItemOverride::class, mappedBy="itemId", fetch="EAGER")
     */
    private $itemOverrides;

    /**
     * @var ItemAbility[]
     *
     * @ORM\OneToMany(targetEntity=ItemAbility::class, mappedBy="item", fetch="EAGER")
     */
    private $itemAbilities;


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
     * @return ItemOverride[]|null
     */
    public function getItemOverrides()
    {
        if (empty($this->itemOverrides)) {
            return null;
        }
        return $this->itemOverrides;
    }

    /**
     * @param ArrayCollection|null $itemOverrides
     */
    public function setItemOverrides($itemOverrides): void
    {
        $this->itemOverrides = $itemOverrides;
    }

    /**
     * @return ItemAbility[]
     */
    public function getItemAbilities(): array
    {
        return $this->itemAbilities;
    }

    /**
     * @param ItemAbility[] $itemAbilities
     */
    public function setItemAbilities(array $itemAbilities): void
    {
        $this->itemAbilities = $itemAbilities;
    }

    /**
     * @return string|null
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * @param string $rarity
     */
    public function setRarity(string $rarity): void
    {
        $this->rarity = $rarity;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime $updated_at
     */
    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return bool
     */
    public function isCountable(): bool
    {
        return false;
    }

    public abstract function getBaseItem();

    /**
     * By Bahamut, I hate the magic in this function. That being said...
     *
     * @return $this
     */
    public function applyItemOverrides ()
    {
        if (is_iterable($this->getItemOverrides())) {
            foreach ($this->getItemOverrides() as $itemOverride) {
                try {
                    $key = Tools::snakeCaseToCamelCase($itemOverride->getOverrideKey(), false);
                    $class = new ReflectionClass($this->getBaseItem());
                    $property = $class->getProperty($key);
                    $property->setAccessible(true);
                    if ($itemOverride->isAppend()) {
                        $property->setValue($this->getBaseItem(), Tools::append($property->getValue(), $itemOverride->getValue()));
                    } else {
                        $property->setValue($this->getBaseItem(), $itemOverride->getValue());
                    }
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }

        $this->setItemOverrides(null);

        return $this;
    }
}
