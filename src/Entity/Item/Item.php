<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

use App\Entity\Item\Armor;

/**
 * @ORM\Table(name="item")
 * @Serializer\ExclusionPolicy("ALL")
 * @ORM\Entity()
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="integer")
 * @ORM\DiscriminatorMap({
 *     "Item",
 *     1 = "Armor"
 * })
 * @Serializer\Discriminator(disabled=true)
 */
class Item
{
    const COST_COPPER_OVERRIDE = 'cost_copper';

    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     *
     * @Serializer\Expose()
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string")
     */
    private $source;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCostCopper()
    {
        return $this->costCopper;
    }

    /**
     * @param int $costCopper
     */
    public function setCostCopper(int $costCopper)
    {
        $this->costCopper = $costCopper;
    }

    /**
     * @return float
     */
    public function getWeightPounds()
    {
        return $this->weightPounds;
    }

    /**
     * @param float $weightPounds
     */
    public function setWeightPounds(float $weightPounds)
    {
        $this->weightPounds = $weightPounds;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source)
    {
        $this->source = $source;
    }


    /**
     * OK, I will fully admit that this function only exists because I'm dumb. Pull requests welcome
     *
     * @Serializer\PreSerialize()
     */
    private function doPreSerializationMagic (){

    }


}
