<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use App\Entity\Item\BaseArmor;

/**
 * @ORM\Table(name="armor")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class Armor extends Item
{
    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;


    /**
     * @var Item
     *
     * @ORM\OneToOne(targetEntity=Item::class, cascade={"PERSIST"})
     * @ORM\JoinColumn(name="item_id")
     *
     */
    private $item;

    /**
     * @var BaseArmor
     *
     * @ORM\ManyToOne(targetEntity=BaseArmor::class, inversedBy="id", cascade={"PERSIST"})
     * @ORM\JoinColumn(name="base_armor_id")
     * @Serializer\Expose()
     * @Serializer\Inline()
     */
    private $baseItem;

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
     * @return BaseArmor
     */
    public function getBaseArmor(): BaseArmor
    {
        return $this->baseItem;
    }

    /**
     * @param BaseArmor $baseArmor
     */
    public function setBaseArmor(BaseArmor $baseArmor): void
    {
        $this->baseItem = $baseArmor;
    }
}