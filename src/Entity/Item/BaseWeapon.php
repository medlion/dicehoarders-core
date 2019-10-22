<?php


namespace App\Entity\Item;


use App\Entity\Ability\Ability;
use Doctrine\ORM\Mapping as ORM;

class BaseWeapon
{
    const CLASS_MARTIAL = 'Martial';
    const CLASS_SIMPLE = 'Simple';


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
     * @var int
     *
     * @ORM\Column(name="damage_die_amount", type="integer")
     */
    protected $damageDieAmount;

    /**
     * @var int
     *
     * @ORM\Column(name="damage_die_type", type="integer")
     */
    protected $damageDieType;

    /**
     * @var string
     *
     * @ORM\Column(name="damage_type", type="string")
     */
    protected $damageType;

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string")
     */
    protected $class;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ranged", type="boolean")
     */
    protected $ranged;

    /**
     * @var Ability[]
     *
     * @ORM\Column(name="properties", type="json")
     * @ORM\OneToOne(targetEntity=Ability::class)
     */
    protected $properties = [];

    /**
     * @var int
     */
    protected $rangeNormal;

    /**
     * @var int
     */
    protected $rangeDisadvantage;

    /**
     * @var string
     */
    protected $ammunition;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getBaseItemName(): string
    {
        return $this->baseItemName;
    }

    /**
     * @param string $baseItemName
     */
    public function setBaseItemName(string $baseItemName): void
    {
        $this->baseItemName = $baseItemName;
    }

    /**
     * @return int
     */
    public function getCostCopper(): int
    {
        return $this->costCopper;
    }

    /**
     * @param int $costCopper
     */
    public function setCostCopper(int $costCopper): void
    {
        $this->costCopper = $costCopper;
    }

    /**
     * @return float
     */
    public function getWeightPounds(): float
    {
        return $this->weightPounds;
    }

    /**
     * @param float $weightPounds
     */
    public function setWeightPounds(float $weightPounds): void
    {
        $this->weightPounds = $weightPounds;
    }

    /**
     * @return int
     */
    public function getDamageDieAmount(): int
    {
        return $this->damageDieAmount;
    }

    /**
     * @param int $damageDieAmount
     */
    public function setDamageDieAmount(int $damageDieAmount): void
    {
        $this->damageDieAmount = $damageDieAmount;
    }

    /**
     * @return int
     */
    public function getDamageDieType(): int
    {
        return $this->damageDieType;
    }

    /**
     * @param int $damageDieType
     */
    public function setDamageDieType(int $damageDieType): void
    {
        $this->damageDieType = $damageDieType;
    }

    /**
     * @return string
     */
    public function getDamageType(): string
    {
        return $this->damageType;
    }

    /**
     * @param string $damageType
     */
    public function setDamageType(string $damageType): void
    {
        $this->damageType = $damageType;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @return bool
     */
    public function isRanged(): bool
    {
        return $this->ranged;
    }

    /**
     * @param bool $ranged
     */
    public function setRanged(bool $ranged): void
    {
        $this->ranged = $ranged;
    }

    /**
     * @return Ability[]|null
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param Ability[]|null $properties
     */
    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }
}
