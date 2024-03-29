<?php


namespace App\Manager\Item;


use App\Entity\Campaign\Campaign;
use App\Entity\Item\Countable;
use App\Entity\Item\Item;
use App\Entity\Item\ItemOverride;
use App\ExceptionHandling\UserFriendlyException;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;

class ItemManager
{
    public const publicItemSources = [
        'SRD'
    ];


    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }


    /**
     * @param int $itemId
     * @return Item
     * @throws UserFriendlyException
     */
    public function getItemById (int $itemId)
    {
        $item = $this->entityManager->getRepository(Item::class)->find($itemId);
        if (!$item instanceof Item) {
            throw new UserFriendlyException('Item not found');
        }
        return $item;
    }


    /**
     * @return Item[]
     */
    public function getAllItems ()
    {
        return $this->entityManager->getRepository(Item::class)->findAll();
    }


    /**
     * @param Campaign $campaign
     * @param Item $item
     * @return bool
     */
    public function isValidItemForCampaign (Campaign $campaign, Item $item)
    {
        $source = $item->getSource();

        if (in_array($source, self::publicItemSources, true)) {
            return true;
        }

        if ($campaign->getId() === (int)$item->getSource()) {
            return true;
        }

        return false;
    }

    /**
     * TODO Remove this function
     *
     * @param Item $item
     * @return mixed
     * @throws \Exception
     */
    public function applyItemOverridesAsArray (Item $item)
    {
        $itemArray = json_decode($this->serializer->serialize($item, 'json'), true);

        foreach ($item->getItemOverrides() as $itemOverride) {
            if (!$itemOverride instanceof ItemOverride) {
                throw new \Exception('Not an instance of ItemOverride');
            }

            if (isset($itemArray[$itemOverride->getOverrideKey()])) {
                if ($itemOverride->isAppend()) {
                    if (is_int($itemArray[$itemOverride->getOverrideKey()])) {
                        $itemArray[$itemOverride->getOverrideKey()] += (int)$itemOverride->getValue();
                    } elseif (is_string($itemArray[$itemOverride->getOverrideKey()])) {
                        $itemArray[$itemOverride->getOverrideKey()] .= PHP_EOL . $itemOverride->getValue();
                    } else {
                        throw new \Exception('Unknown type to append');
                    }
                } else {
                    $itemArray[$itemOverride->getOverrideKey()] = $itemOverride->getValue();
                }
            }
        }

        return $itemArray;
    }

    /**
     * TODO Move this functionality to the CharacterItem manager
     *
     * @param Item $item
     * @return Item
     */
    public function getItemAsObject (Item $item)
    {
        return $item->applyItemOverrides();
    }

    /**
     * @param Item $item
     * @param int $count
     * @return int
     */
    public function getCountableItemCarryWeight (Item $item, int $count=1)
    {
        if (!$item->getBaseItem() instanceof Countable) {
            return $item->getWeightPounds() * $count;
        }

        $weight = (int)($count/$this->getItemAsObject($item)->getBaseItem()->getBundleSize());
        if ($count % $item->applyItemOverrides()->getBaseItem()->getBundleSize() !== 0) {
            $weight++;
        }

        return $weight;
    }
}
