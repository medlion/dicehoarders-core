<?php


namespace App\Entity\Ability;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="ability_override")
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("NONE")
 */
class AbilityOverride extends AbilityMap
{
    /**
     * @var int
     *
     * @ORM\GeneratedValue()
     * @ORM\OneToOne(targetEntity=AbilityMap::class, cascade={"PERSIST"})
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="override_key", type="string")
     */
    private $overrideKey;

    /**
     * @var string
     * @ORM\Column(name="value", type="string")
     */
    private $value;

    /**
     * @var boolean
     * @ORM\Column(name="is_append", type="boolean")
     */
    private $isAppend;

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
    public function getOverrideKey(): string
    {
        return $this->overrideKey;
    }

    /**
     * @param string $overrideKey
     */
    public function setOverrideKey(string $overrideKey): void
    {
        $this->overrideKey = $overrideKey;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isAppend(): bool
    {
        return $this->isAppend;
    }

    /**
     * @param bool $isAppend
     */
    public function setIsAppend(bool $isAppend): void
    {
        $this->isAppend = $isAppend;
    }
}
