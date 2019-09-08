<?php


namespace App\Manager;


use App\Entity\SfUser;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserAPIManager
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
     * @param SfUser $user
     * @return JsonResponse
     */
    public function userLoggedInResponse (SfUser $user)
    {
        $context = new SerializationContext();
        $context->setGroups(['login']);

        return new JsonResponse($this->serializer->serialize($user, 'json', $context), 200, [], true);
    }
}
