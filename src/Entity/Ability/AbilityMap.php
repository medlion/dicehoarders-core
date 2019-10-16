<?php


namespace App\Entity\Ability;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="ability_map")
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="ability_component_id", type="integer")
 * @ORM\DiscriminatorMap({
 *             "Ability",
 *              1 = "AbilityGeneric",
 * })
 * @Serializer\Discriminator(disabled=true)
 */
class AbilityMap
{
    /**
     * @var Ability
     *
     * @ORM\ManyToOne(targetEntity=Ability::class, inversedBy="abilityComponents")
     * @ORM\JoinColumn(name="ability_id", referencedColumnName="id")
     */
    private $ability;

}
