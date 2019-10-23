<?php


namespace App\Entity\Ability;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="ability_map")
 * @ORM\Entity()
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="ability_partial_type", type="integer")
 * @ORM\DiscriminatorMap({
 *              1 = "AbilityGeneric",
 *              2 = "AbilityOverride",
 * })
 * @Serializer\Discriminator(disabled=true)
 */
abstract class AbilityMap
{
    /**
     * @var Ability
     *
     * @ORM\ManyToOne(targetEntity=Ability::class, inversedBy="abilityComponents", cascade={"persist"})
     * @ORM\JoinColumn(name="ability_id", referencedColumnName="id")
     * @ORM\GeneratedValue()
     */
    private $ability;


    /**
     * @var int
     *
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue()
     * @ORM\Id()
     */
    private $id;

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





}
