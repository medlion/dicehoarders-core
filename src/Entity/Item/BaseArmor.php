<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="base_armor")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class BaseArmor
{
    const CLASS_LIGHT_ARMOR = 'Light Armor';
    const CLASS_MEDIUM_ARMOR = 'Medium Armor';
    const CLASS_HEAVY_ARMOR = 'Heavy Armor';

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
     * @var string
     *
     * @ORM\Column(name="class", type="string")
     * @Serializer\Expose()
     */
    private $class;

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
     * @ORM\Column(name="base_ac", type="integer")
     * @Serializer\Expose()
     */
    protected $baseAC;

    /**
     * @var int
     *
     * @ORM\Column(name="max_dex_ac_bonus", type="integer")
     * @Serializer\Expose()
     */
    protected $maxDexBonus;

    /**
     * @var int
     *
     * @ORM\Column(name="other_ac_bonus", type="integer")
     * @Serializer\Expose()
     */
    protected $otherBonus;

    /**
     * @var int
     *
     * @ORM\Column(name="min_str_requirement", type="integer")
     * @Serializer\Expose()
     */
    protected $strRequirement;

    /**
     * @var bool
     *
     * @ORM\Column(name="stealth_disadvantage", type="boolean")
     * @Serializer\Expose()
     */
    protected $stealthDisadvantage;

    /**
     * @var int
     *
     * @ORM\Column(name="don_time_turns", type="integer")
     * @Serializer\Expose()
     */
    protected $donTimeTurns;

    /**
     * @var int
     *
     * @ORM\Column(name="doff_time_turns", type="integer")
     * @Serializer\Expose()
     */
    protected $doffTimeTurns;

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
    public function getBaseAC(): int
    {
        return $this->baseAC;
    }

    /**
     * @param int $baseAC
     */
    public function setBaseAC(int $baseAC): void
    {
        $this->baseAC = $baseAC;
    }

    /**
     * @return int
     */
    public function getMaxDexBonus(): int
    {
        return $this->maxDexBonus;
    }

    /**
     * @param int|null $maxDexBonus
     */
    public function setMaxDexBonus(int $maxDexBonus): void
    {
        $this->maxDexBonus = $maxDexBonus;
    }

    /**
     * @return int
     */
    public function getOtherBonus(): int
    {
        return $this->otherBonus;
    }

    /**
     * @param int $otherBonus
     */
    public function setOtherBonus(int $otherBonus): void
    {
        $this->otherBonus = $otherBonus;
    }

    /**
     * @return int
     */
    public function getStrRequirement(): int
    {
        return $this->strRequirement;
    }

    /**
     * @param int $strRequirement
     */
    public function setStrRequirement(int $strRequirement): void
    {
        $this->strRequirement = $strRequirement;
    }

    /**
     * @return bool
     */
    public function isStealthDisadvantage(): bool
    {
        return $this->stealthDisadvantage;
    }

    /**
     * @param bool $stealthDisadvantage
     */
    public function setStealthDisadvantage(bool $stealthDisadvantage): void
    {
        $this->stealthDisadvantage = $stealthDisadvantage;
    }

    /**
     * @return int
     */
    public function getDonTimeTurns(): int
    {
        return $this->donTimeTurns;
    }

    /**
     * @param int $donTimeTurns
     */
    public function setDonTimeTurns(int $donTimeTurns): void
    {
        $this->donTimeTurns = $donTimeTurns;
    }

    /**
     * @return int
     */
    public function getDoffTimeTurns(): int
    {
        return $this->doffTimeTurns;
    }

    /**
     * @param int $doffTimeTurns
     */
    public function setDoffTimeTurns(int $doffTimeTurns): void
    {
        $this->doffTimeTurns = $doffTimeTurns;
    }
}
