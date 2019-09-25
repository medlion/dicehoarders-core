<?php


namespace App\Entity\Character;

use App\Entity\Item\Container;
use App\Entity\Item\Item;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="character_item")
 * @Serializer\ExclusionPolicy("ALL")
 */
class CharacterItem
{
    /**
     * @var Character
     *
     * @ORM\OneToOne(targetEntity=Character::class)
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
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
     * @var Container
     *
     * @ORM\OneToOne(targetEntity=Container::class)
     */
    private $holdingItem;

    private $count;
}
