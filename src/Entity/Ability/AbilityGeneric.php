<?php


namespace App\Entity\Ability;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="ability_generic")
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("NONE")
 */
class AbilityGeneric extends Ability
{
    /**
     * @var Ability
     * @ORM\OneToOne(targetEntity=Ability::class, cascade={"PERSIST"})
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     * @ORM\GeneratedValue()
     */
    private $ability;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @return Ability
     */
    public function getAbility(): Ability
    {
        return $this->ability;
    }

    /**
     * @param Ability $ability
     */
    public function setAbility(Ability $ability): void
    {
        $this->ability = $ability;
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