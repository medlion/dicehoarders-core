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
    protected $type = 'Container';

    const CONTAINER_MAX_WEIGHT_POUNDS = 'maximum_weight_pounds';
    const COUNTAINER_MAX_HOLD_OF_TYPE = 'maximum_specific_item_number';

    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\OneToOne(targetEntity=Item::class, cascade={"PERSIST"})
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $id;

    /**
     * @var BaseContainer
     *
     * @ORM\OneToOne(targetEntity=BaseContainer::class, cascade={"PERSIST"}, fetch="EAGER")
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
