<?php


namespace App\Entity\Ability;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="ability")
 * @ORM\Entity()
 *
 */
class Ability
{

    /**
     * @var int;
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     * @Serializer\Exclude()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="recharge_time", type="integer")
     */
    private $rechargeTime;

    /**
     * TODO Map onto time unit table
     *
     * @var string
     *
     * @ORM\Column(name="recharge_time_unit", type="string")
     */
    private $rechargeTimeUnit;

    /**
     * @var string
     *
     * @ORM\Column(name="recharge_amount", type="string")
     */
    private $rechargeAmount;

    /**
     * @var DateTime
     * @ORM\Column(name="created_at", type="datetime")
     * @Serializer\Exclude()
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=AbilityMap::class, mappedBy="ability")
     */
    private $abilityPartial;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getRechargeTime(): int
    {
        return $this->rechargeTime;
    }

    /**
     * @param int $rechargeTime
     */
    public function setRechargeTime(int $rechargeTime): void
    {
        $this->rechargeTime = $rechargeTime;
    }

    /**
     * @return string
     */
    public function getRechargeTimeUnit(): string
    {
        return $this->rechargeTimeUnit;
    }

    /**
     * @param string $rechargeTimeUnit
     */
    public function setRechargeTimeUnit(string $rechargeTimeUnit): void
    {
        $this->rechargeTimeUnit = $rechargeTimeUnit;
    }

    /**
     * @return string
     */
    public function getRechargeAmount(): string
    {
        return $this->rechargeAmount;
    }

    /**
     * @param string $rechargeAmount
     */
    public function setRechargeAmount(string $rechargeAmount): void
    {
        $this->rechargeAmount = $rechargeAmount;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
}
