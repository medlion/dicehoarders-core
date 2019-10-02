<?php


namespace App\Entity\Character;

use App\Entity\Item\Container;
use App\Entity\Item\Item;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="character_item")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class CharacterItem
{
    /**
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
     * @var Container
     *
     * @ORM\OneToOne(targetEntity=Container::class)
     */
    private $holdingItem;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $count;

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
     * @return Container
     */
    public function getHoldingItem()
    {
        return $this->holdingItem;
    }

    /**
     * @param Container $holdingItem
     */
    public function setHoldingItem(Container $holdingItem)
    {
        $this->holdingItem = $holdingItem;
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


}
