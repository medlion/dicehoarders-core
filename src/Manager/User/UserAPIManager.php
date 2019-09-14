<?php


namespace App\Manager\User;


use App\Entity\User\SfUser;
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
        $context->setGroups(['loginresponse']);

        return new JsonResponse($this->serializer->serialize($user, 'json', $context), 200, [], true);
    }
}
