<?php


namespace App\DataFixtures;


use App\Entity\Item\Armor;
use App\Entity\Item\BaseArmor;
use App\Entity\Item\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MundaneItemFixtures extends Fixture implements FixtureGroupInterface
{

    private const BASE_ARMOR_DESCRIPTION = [
        'Padded Armor' => 'Padded armor consists of quilted layers of cloth and batting',
        'Leather Armor' => 'The breastplate and shoulder protectors of this armor are made of leather that has been stiffened by being boiled in oil. The rest of the armor is made of softer and more flexible materials.',
        'Studded Leather Armor' => 'Made from tough but flexible leather, studded leather is reinforced with close-set rivets or spikes.',
        'Hide Armor' => 'This crude armor consists of thick furs and pelts. It is commonly worn by barbarian tribes, evil humanoids, and other folk who lack access to the tools and materials needed to create better armor.',
        'Chain Shirt' => 'Made of interlocking metal rings, a chain shirt is worn between layers of clothing or leather. This armor offers modest protection to the wearer’s upper body and allows the sound of the   rings rubbing against one another to be muffled by outer layers.',
        'Scale Mail' => 'This armor consists of a coat and leggings (and perhaps a separate skirt) of leather covered with overlapping pieces of metal, much like the scales of a fish. The suit includes gauntlets.',
        'Breastplate' => 'This armor consists of a fitted metal chest piece worn with supple leather. Although it leaves the legs and arms relatively unprotected, this armor provides good protection for the wearer’s vital organs while leaving the wearer relatively unencumbered.',
        'Half Plate' => 'Half plate consists of shaped metal plates that cover most of the wearer’s body.It does not include leg protection beyond simple greaves that are attached with leather straps',
        'Ring Mail' => 'This armor is leather armor with heavy rings sewn into it. The rings help reinforce the armor against blows from swords and axes. Ring mail is inferior to chain mail, and it\'s usually worn only by those who can’t afford better armor.',
        'Chain Mail' => 'Made of interlocking metal rings, chain mail includes a layer of quilted fabric worn underneath the mail to prevent chafing and to cushion the impact of blows. The suit includes gauntlets.',
        'Splint Armor' => 'This armor is made of narrow vertical strips of metal riveted to a backing of leather that is worn over cloth padding. Flexible chain mail protects the joints.',
        'Plate Armor' => 'Plate consists of shaped, interlocking metal plates to cover the entire body. A suit of plate includes gauntlets, heavy leather boots, a visored helmet, and thick layers of padding underneath the armor. Buckles and straps distribute the weight over the body,',
        ];

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['mundane_items'];
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $baseArmors = $manager->getRepository(BaseArmor::class)->findAll();
        foreach ($baseArmors as $baseArmor) {
            $armor = new Armor();
            $armor->setName($baseArmor->getBaseItemName());
            $armor->setDescription(self::BASE_ARMOR_DESCRIPTION[$baseArmor->getBaseItemName()]);
            $armor->setSource(Item::SOURCE_SRD);
            $armor->setRarity(Item::RARITY_MUNDANE);
            $armor->setBaseItem($baseArmor);
            $armor->setCreatedAt(new \DateTime());
            $armor->setUpdatedAt(new \DateTime());
            $manager->persist($armor);
        }

        $manager->flush();
    }
}