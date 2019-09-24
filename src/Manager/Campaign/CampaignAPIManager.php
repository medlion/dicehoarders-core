<?php


namespace App\Manager\Campaign;


use App\Entity\Campaign\Campaign;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CampaignAPIManager
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function campaignResponse (Campaign $campaign)
    {
        $context = new SerializationContext();
        $context->setGroups(['campaigndetailsresponse']);

        return new JsonResponse($this->serializer->serialize($campaign, 'json', $context), 200, [], true);
    }

    public function campaignAdminResponse (Campaign $campaign)
    {
        $context = new SerializationContext();
        $context->setGroups(['campaignadminsresponse']);

        return new JsonResponse($this->serializer->serialize($campaign, 'json', $context), 200, [], true);
    }

    public function campaignDMResponse (Campaign $campaign)
    {
        $context = new SerializationContext();
        $context->setGroups(['campaigndmresponse']);

        return new JsonResponse($this->serializer->serialize($campaign, 'json', $context), 200, [], true);
    }
}
