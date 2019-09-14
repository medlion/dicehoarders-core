<?php


namespace App\Entity\Item;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="item_override")
 * @Serializer\ExclusionPolicy("NONE")
 * @ORM\Entity()
 */
class ItemOverride
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue()
     * @ORM\Id()
     */
    private $id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="itemOverrides")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     *
     */
    private $itemId;

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
     * @return int
     */
    public function getItemId(): int
    {
        return $this->itemId;
    }

    /**
     * @param int $itemId
     */
    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
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
