<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="base_armor")
 * @Serializer\ExclusionPolicy("ALL")
 * @ORM\Entity()
 */
class BaseArmor
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue()
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
     * @ORM\Column(name="class", type="string")
     * @Serializer\Expose()
     */
    private $class;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_copper", type="integer")
     * @Serializer\Expose()
     */
    private $costCopper;

    /**
     * @var float
     *
     * @ORM\Column(name="weight_pounds", type="float")
     */
    private $weightPounds;

    /**
     * @var int
     *
     * @ORM\Column(name="base_ac", type="integer")
     */
    private $baseAC;

    /**
     * @var int
     *
     * @ORM\Column(name="max_dex_ac_bonus", type="integer")
     */
    private $maxDexBonus;

    /**
     * @var int
     *
     * @ORM\Column(name="other_ac_bonus", type="integer")
     */
    private $otherBonus;

    /**
     * @var int
     *
     * @ORM\Column(name="min_str_requirement", type="integer")
     */
    private $strRequirement;

    /**
     * @var bool
     *
     * @ORM\Column(name="stealth_disadvantage", type="boolean")
     */
    private $stealthDisadvantage;

    /**
     * @var int
     *
     * @ORM\Column(name="don_time_turns", type="integer")
     */
    private $donTimeTurns;

    /**
     * @var int
     *
     * @ORM\Column(name="doff_time_turns", type="integer")
     */
    private $doffTimeTurns;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return int
     */
    public function getCostCopper(): int
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
     * @return int
     */
    public function getBaseAC(): int
    {
        return $this->baseAC;
    }

    /**
     * @return int
     */
    public function getMaxDexBonus(): int
    {
        return $this->maxDexBonus;
    }

    /**
     * @return int
     */
    public function getOtherBonus(): int
    {
        return $this->otherBonus;
    }

    /**
     * @return int
     */
    public function getStrRequirement(): int
    {
        return $this->strRequirement;
    }

    /**
     * @return bool
     */
    public function isStealthDisadvantage(): bool
    {
        return $this->stealthDisadvantage;
    }

    /**
     * @return int
     */
    public function getDonTimeTurns(): int
    {
        return $this->donTimeTurns;
    }

    /**
     * @return int
     */
    public function getDoffTimeTurns(): int
    {
        return $this->doffTimeTurns;
    }


}