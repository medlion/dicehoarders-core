<?php


namespace App\Entity\Ability;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="ability_generic")
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("NONE")
 */
class AbilityGeneric extends AbilityMap
{
    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\OneToOne(targetEntity=AbilityMap::class, cascade={"PERSIST"})
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     * @ORM\Id()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


}
