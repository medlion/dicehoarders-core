<?php


namespace App\Entity\Item;

use Doctrine\ORM\Mapping as ORM;

abstract class Countable
{
    private $countable = true;

    /**
     * @var int
     *
     * @ORM\Column(name="bundle_size", type="integer")
     */
    protected $bundleSize;

    /**
     * @return bool
     */
    public function isCountable(): bool
    {
        return $this->countable;
    }

    /**
     * @return int
     */
    public function getBundleSize(): int
    {
        return $this->bundleSize;
    }

    /**
     * @param int $bundleSize
     */
    public function setBundleSize(int $bundleSize): void
    {
        $this->bundleSize = $bundleSize;
    }
}
