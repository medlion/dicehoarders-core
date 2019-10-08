<?php


namespace App\Manager\Character;


use App\Entity\Character\Character;
use App\Entity\Character\CharacterItem;
use App\Manager\APIManager;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\JsonResponse;

class CharacterAPIManager extends APIManager
{
    public function characterResponse (Character $character)
    {
        $context = new SerializationContext();
        $context->setGroups('characterlisting');

        return new JsonResponse($this->getSerializer()->serialize($character, 'json', $context), 200, [], true);
    }

    public function campaignGiveCharacterItemResponse (CharacterItem $characterItem)
    {
        $context = new SerializationContext();
        $context->enableMaxDepthChecks();

        return new JsonResponse($this->getSerializer()->serialize($characterItem, 'json', $context), 200, [], true);
    }
}
