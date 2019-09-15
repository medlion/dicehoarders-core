<?php


namespace App\Manager\Item;


use App\Entity\Item\Armor;
use App\Entity\Item\Item;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Decorator\EntityManagerDecorator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ItemManager
{
    public const ItemTypes = [
        1 => 'armor'
    ];

    /**
     * @var ObjectManager
     */
    private $objectManager;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @return Item[]|object[]
     */
    public function getAllItems ()
    {
        //dd ($this->entityManager->getRepository(Item::class)->findAll());
        return $this->entityManager->getRepository(Item::class)->findAll();
    }


}
