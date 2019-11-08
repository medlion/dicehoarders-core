<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Table(name="weapon")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class Weapon extends Item
{
    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\OneToOne(targetEntity=Item::class, cascade={"PERSIST"})
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $id;

    /**
     * @var BaseWeapon
     *
     * @ORM\OneToOne(targetEntity=BaseWeapon::class, cascade={"PERSIST"}, fetch="EAGER")
     * @ORM\JoinColumn(name="base_weapon_id", referencedColumnName="id")
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
     * @return BaseWeapon
     */
    public function getBaseItem(): BaseWeapon
    {
        return $this->baseItem;
    }

    /**
     * @param BaseWeapon $baseItem
     */
    public function setBaseItem(BaseWeapon $baseItem): void
    {
        $this->baseItem = $baseItem;
    }


}
