<?php


namespace App\Manager\Character;


use App\Entity\Character\Character;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CharacterAPIManager
{

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function characterResponse (Character $character)
    {
        $context = new SerializationContext();

        return new JsonResponse($this->serializer->serialize($character, 'json', $context), 200, [], true);
    }
}
