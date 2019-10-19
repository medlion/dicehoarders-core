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
     * @ORM\ManyToOne(targetEntity=Ability::class, inversedBy="abilityComponents")
     * @ORM\JoinColumn(name="ability_id", referencedColumnName="id")
     */
    private $ability;


    /**
     * @var int
     *
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue()
     * @ORM\Id()
     */
    private $abilityPartialId;

}
