<?php


namespace App\Entity\Item;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="base_coinage")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class BaseCoinage extends Countable
{

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue()
     * @Serializer\Exclude()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Serializer\Exclude()
     */
    private $baseItemName;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_copper", type="integer")
     */
    protected $costCopper;

    /**
     * @var float
     */
    private $weightPounds = 0.02;

    /**
     * @var int
     */
    private $bundleSize = 1;

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
    public function getBaseItemName(): string
    {
        return $this->baseItemName;
    }

    /**
     * @param string $baseItemName
     */
    public function setBaseItemName(string $baseItemName): void
    {
        $this->baseItemName = $baseItemName;
    }

    /**
     * @return int
     */
    public function getCostCopper(): int
    {
        return $this->costCopper;
    }

    /**
     * @param int $costCopper
     */
    public function setCostCopper(int $costCopper): void
    {
        $this->costCopper = $costCopper;
    }

    /**
     * @return float
     */
    public function getWeightPounds(): float
    {
        return $this->weightPounds;
    }
}
