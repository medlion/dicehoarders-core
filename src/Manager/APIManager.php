<?php


namespace App\Manager;


use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class APIManager
{

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function jsonSerialize ($object)
    {
        $context = new SerializationContext();
        return new JsonResponse($this->getSerializer()->serialize($object, 'json', $context), 200, [], true);
    }

    protected function getSerializer ()
    {
        return $this->serializer;
    }
}