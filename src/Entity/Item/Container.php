<?php


namespace App\Entity\Item;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="container")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class Container extends Item
{
    protected $type = 'container';

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
     * @var BaseContainer
     *
     * @ORM\ManyToOne(targetEntity=BaseContainer::class, cascade={"PERSIST"}, fetch="EAGER")
     * @ORM\JoinColumn(name="base_container_id", referencedColumnName="id")
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
     * @return BaseContainer
     */
    public function getBaseItem(): BaseContainer
    {
        if (!empty($this->baseItem)) {
            return $this->baseItem;
        }
        return new BaseContainer();
    }

    /**
     * @param BaseContainer $baseItem
     */
    public function setBaseItem(BaseContainer $baseItem): void
    {
        $this->baseItem = $baseItem;
    }



}
