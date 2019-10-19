<?php


namespace App\Entity\Item;

use App\Entity\Ability\Ability;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="item_ability")
 * @ORM\Entity()
 */
class ItemAbility
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue()
     * @ORM\Id()
     * @Serializer\Exclude()
     */
    private $id;

    /**
     * @var Item
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="itemAbilities")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     *
     * @Serializer\Exclude()
     *
     */
    private $item;

    /**
     * @var Ability
     * @ORM\OneToOne(targetEntity=Ability::class)
     * @ORM\JoinColumn(name="ability_id", referencedColumnName="id")
     * @Serializer\Inline()
     */
    private $ability;

    /**
     * @var int;
     *
     * @ORM\Column(name="attunement_level_required", type="integer")
     */
    private $attunementLevelRequired;

    /**
     * @var array
     *
     * @ORM\Column(name="attune_by", type="json")
     * @var string[]
     */
    private $attuneBy = [];

    /**
     * @var boolean
     *
     * @ORM\Column(name="requires_proficiency", type="boolean")
     */
    private $requiresProficiency;

    /**
     * @var boolean
     *
     * @ORM\Column(name="always_on", type="boolean")
     */
    private $alwaysOn;

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
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem(Item $item): void
    {
        $this->item = $item;
    }

    /**
     * @return Ability
     */
    public function getAbility(): Ability
    {
        return $this->ability;
    }

    /**
     * @param Ability $ability
     */
    public function setAbility(Ability $ability): void
    {
        $this->ability = $ability;
    }

    /**
     * @return int
     */
    public function getAttunementLevelRequired(): int
    {
        return $this->attunementLevelRequired;
    }

    /**
     * @param int $attunementLevelRequired
     */
    public function setAttunementLevelRequired(int $attunementLevelRequired): void
    {
        $this->attunementLevelRequired = $attunementLevelRequired;
    }

    /**
     * @return array
     */
    public function getAttuneBy(): array
    {
        return $this->attuneBy;
    }

    /**
     * @param array $attuneBy
     */
    public function setAttuneBy(array $attuneBy): void
    {
        $this->attuneBy = $attuneBy;
    }

    /**
     * @return bool
     */
    public function isRequiresProficiency(): bool
    {
        return $this->requiresProficiency;
    }

    /**
     * @param bool $requiresProficiency
     */
    public function setRequiresProficiency(bool $requiresProficiency): void
    {
        $this->requiresProficiency = $requiresProficiency;
    }

    /**
     * @return bool
     */
    public function isAlwaysOn(): bool
    {
        return $this->alwaysOn;
    }

    /**
     * @param bool $alwaysOn
     */
    public function setAlwaysOn(bool $alwaysOn): void
    {
        $this->alwaysOn = $alwaysOn;
    }


}
