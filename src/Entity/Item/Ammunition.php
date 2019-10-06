<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use App\Entity\Item\BaseAmmunition;

/**
 * @ORM\Table(name="ammunition")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class Ammunition extends Item
{
    protected $type = 'Ammunition';

    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\OneToOne(targetEntity=Item::class, cascade={"PERSIST"})
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $id;

    /**
     * @var BaseAmmunition
     *
     * @ORM\OneToOne(targetEntity=BaseAmmunition::class, cascade={"PERSIST"}, fetch="EAGER")
     * @ORM\JoinColumn(name="base_ammunition_id", referencedColumnName="id")
     * @Serializer\Expose()
     * @Serializer\Inline()
     */
    private $baseItem;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

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
     * @return BaseAmmunition
     */
    public function getBaseItem(): BaseAmmunition
    {
        return $this->baseItem;
    }

    /**
     * @param BaseAmmunition $baseItem
     */
    public function setBaseItem(BaseAmmunition $baseItem): void
    {
        $this->baseItem = $baseItem;
    }
}