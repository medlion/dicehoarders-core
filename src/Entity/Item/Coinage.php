<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="coinage")
 * @Serializer\ExclusionPolicy("NONE")
 * @Entity()
 */
class Coinage extends Item
{
    protected $type = 'Coinage';

    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\OneToOne(targetEntity=Item::class, cascade={"PERSIST"})
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $id;

    /**
     * @var BaseCoinage
     *
     * @ORM\OneToOne(targetEntity=BaseCoinage::class, cascade={"PERSIST"}, fetch="EAGER")
     * @ORM\JoinColumn(name="base_coinage_id", referencedColumnName="id")
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
     * @return BaseCoinage
     */
    public function getBaseItem(): BaseCoinage
    {
        if (!empty($this->baseItem)) {
            return $this->baseItem;
        }
        return new BaseCoinage();
    }

    /**
     * @param BaseCoinage $baseItem
     */
    public function setBaseItem(BaseCoinage $baseItem): void
    {
        $this->baseItem = $baseItem;
    }


}
