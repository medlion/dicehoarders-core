<?php


namespace App\Entity\Item;



abstract class Countable
{
    private $countable = true;

    /**
     * @return bool
     */
    public function isCountable(): bool
    {
        return $this->countable;
    }


}
