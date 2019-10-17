<?php


namespace App\Entity\Character;

use App\Entity\Ability\AbilityOverride;
use App\Entity\Item\Container;
use App\Entity\Item\Item;
use App\Helper\Tools;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use ReflectionClass;

/**
 * @ORM\Table(name="character_item")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class CharacterItem
{
    /**
     * @var int
     *
     * @Serializer\Exclude())
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var Character
     *
     * @ORM\OneToOne(targetEntity=Character::class)
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
     * @Serializer\MaxDepth(1)
     */
    private $character;

    /**
     * @var Item
     *
     * @ORM\OneToOne(targetEntity=Item::class)
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @var CharacterItem
     *
     * @ORM\OneToOne(targetEntity=CharacterItem::class)
     */
    private $holdingItem;

    /**
     * @var int
     * @Serializer\Type("integer")
     *
     * @ORM\Column(name="count")
     */
    private $count;

    /**
     * @var int
     *
     * @ORM\Column(name="attuned_level", type="integer")
     */
    private $attunedLevel;

    /**
     * @var bool
     *
     * @ORM\Column(name="hide_above_attuned_level", type="boolean")
     */
    private $hideAboveAttunedLevel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="apply_dm_overrides", type="boolean")
     */
    private $applyDmOverrides;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @return Character
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param Character $character
     */
    public function setCharacter(Character $character)
    {
        $this->character = $character;
    }

    /**
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @return CharacterItem
     */
    public function getHoldingItem()
    {
        return $this->holdingItem;
    }

    /**
     * @param CharacterItem $holdingItem
     */
    public function setHoldingItem(CharacterItem $holdingItem)
    {
        if ($holdingItem->getItem() instanceof Container) {
            $this->holdingItem = $holdingItem;
        }
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getAttunedLevel(): int
    {
        return $this->attunedLevel;
    }

    /**
     * @param int $attunedLevel
     */
    public function setAttunedLevel(int $attunedLevel): void
    {
        $this->attunedLevel = $attunedLevel;
    }

    /**
     * @return bool
     */
    public function isHideAboveAttunedLevel(): bool
    {
        return $this->hideAboveAttunedLevel;
    }

    /**
     * @param bool $hideAboveAttunedLevel
     */
    public function setHideAboveAttunedLevel(bool $hideAboveAttunedLevel): void
    {
        $this->hideAboveAttunedLevel = $hideAboveAttunedLevel;
    }

    /**
     * @return bool
     */
    public function isApplyDmOverrides(): bool
    {
        return $this->applyDmOverrides;
    }

    /**
     * @param bool $applyDmOverrides
     */
    public function setApplyDmOverrides(bool $applyDmOverrides): void
    {
        $this->applyDmOverrides = $applyDmOverrides;
    }

    /**
     * @return $this
     */
    public function applyPermanentAbilityOverrides ()
    {
        if (is_iterable($this->getItem()->getItemAbilities())) {
            foreach ($this->getItem()->getItemAbilities() as $itemAbility) {
                if ($this->attunedLevel >= $itemAbility->getAttunementLevelRequired() && in_array($itemAbility->getAbility()->getUses(), [null, 0], true)) {
                    foreach ($itemAbility->getAbility()->getAbilityPartial() as $abilityPartial) {
                        if ($abilityPartial instanceof AbilityOverride) {
                            try {
                                $key = Tools::snakeCaseToCamelCase($abilityPartial->getOverrideKey(), false);
                                $class = new ReflectionClass($this->getItem()->getBaseItem());
                                $property = $class->getProperty($key);
                                $property->setAccessible(true);
                                /** TODO Make isAppend */
                                $property->setValue($this->getItem()->getBaseItem(), $abilityPartial->getValue());
                                unset ($abilityPartial);
                            } catch (\Exception $exception) {
                                continue;
                            }
                        }
                    }
                }
            }
        }
        return $this;
    }
}
