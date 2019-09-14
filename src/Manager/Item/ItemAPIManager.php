<?php


namespace App\Manager\Item;


use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemAPIManager
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }


    /**
     * @param array $items
     * @return JsonResponse
     */
    public function allItemsResponse (array $items)
    {
        $context = new SerializationContext();

        return new JsonResponse($this->serializer->serialize($items, 'json', $context), 200, [], true);
    }


}
