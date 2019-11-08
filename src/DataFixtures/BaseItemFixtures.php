<?php


namespace App\DataFixtures;


use App\Entity\Ability\Ability;
use App\Entity\Ability\AbilityGeneric;
use App\Entity\Ability\AbilityOverride;
use App\Entity\Item\BaseAmmunition;
use App\Entity\Item\BaseArmor;
use App\Entity\Item\BaseWeapon;
use App\Entity\Item\ItemAbility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;

class BaseItemFixtures extends Fixture implements FixtureGroupInterface
{

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['base_items'];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getBaseArmors() as $armor) {
            $manager->persist($armor);
        }

        foreach ($this->getBaseAmmunitions() as $ammunition) {
            $manager->persist($ammunition);
        }

        foreach ($this->getWeaponPropertiesAsAbilities() as $weaponProperties) {
            $manager->persist($weaponProperties);
        }

        $manager->flush();

        foreach ($this->getWeaponPropertyAbilityPartials($manager->getRepository(Ability::class)) as $abilityPartial) {
            $manager->persist($abilityPartial);
        }

        foreach ($this->getBaseWeapons($manager->getRepository(Ability::class)) as $baseWeapon) {
            $manager->persist($baseWeapon);
        }

        $manager->flush();
    }

    private function getBaseArmors ()
    {
        $armors = [];

        $padded = new BaseArmor();
        $padded->setBaseItemName('Padded Armor');
        $padded->setClass(BaseArmor::CLASS_LIGHT_ARMOR);
        $padded->setCostCopper(500);
        $padded->setWeightPounds(8);
        $padded->setBaseAC(11);
        $padded->setMaxDexBonus(null);
        $padded->setOtherBonus(0);
        $padded->setStrRequirement(0);
        $padded->setStealthDisadvantage(true);
        $padded->setDonTimeTurns(10);
        $padded->setDoffTimeTurns(10);
        $armors[] = $padded;

        $leather = new BaseArmor();
        $leather->setBaseItemName('Leather Armor');
        $leather->setClass(BaseArmor::CLASS_LIGHT_ARMOR);
        $leather->setCostCopper(1000);
        $leather->setWeightPounds(10);
        $leather->setBaseAC(11);
        $leather->setMaxDexBonus(null);
        $leather->setOtherBonus(0);
        $leather->setStrRequirement(0);
        $leather->setStealthDisadvantage(false);
        $leather->setDonTimeTurns(10);
        $leather->setDoffTimeTurns(10);
        $armors [] = $leather;

        $studdedLeather = new BaseArmor();
        $studdedLeather->setBaseItemName('Studded Leather Armor');
        $studdedLeather->setClass(BaseArmor::CLASS_LIGHT_ARMOR);
        $studdedLeather->setCostCopper(4500);
        $studdedLeather->setWeightPounds(13);
        $studdedLeather->setBaseAC(12);
        $studdedLeather->setMaxDexBonus(null);
        $studdedLeather->setOtherBonus(0);
        $studdedLeather->setStrRequirement(0);
        $studdedLeather->setStealthDisadvantage(false);
        $studdedLeather->setDonTimeTurns(10);
        $studdedLeather->setDoffTimeTurns(10);
        $armors [] = $studdedLeather;

        $hide = new BaseArmor();
        $hide->setBaseItemName('Hide Armor');
        $hide->setClass(BaseArmor::CLASS_MEDIUM_ARMOR);
        $hide->setCostCopper(1000);
        $hide->setWeightPounds(12);
        $hide->setBaseAC(12);
        $hide->setMaxDexBonus(2);
        $hide->setOtherBonus(0);
        $hide->setStrRequirement(0);
        $hide->setStealthDisadvantage(false);
        $hide->setDonTimeTurns(50);
        $hide->setDoffTimeTurns(10);
        $armors [] = $hide;

        $chainShirt = new BaseArmor();
        $chainShirt->setBaseItemName('Chain Shirt');
        $chainShirt->setClass(BaseArmor::CLASS_MEDIUM_ARMOR);
        $chainShirt->setCostCopper(5000);
        $chainShirt->setWeightPounds(20);
        $chainShirt->setBaseAC(13);
        $chainShirt->setMaxDexBonus(2);
        $chainShirt->setOtherBonus(0);
        $chainShirt->setStrRequirement(0);
        $chainShirt->setStealthDisadvantage(false);
        $chainShirt->setDonTimeTurns(50);
        $chainShirt->setDoffTimeTurns(10);
        $armors [] = $chainShirt;

        $scaleMail = new BaseArmor();
        $scaleMail->setBaseItemName('Scale Mail');
        $scaleMail->setClass(BaseArmor::CLASS_MEDIUM_ARMOR);
        $scaleMail->setCostCopper(5000);
        $scaleMail->setWeightPounds(45);
        $scaleMail->setBaseAC(14);
        $scaleMail->setMaxDexBonus(2);
        $scaleMail->setOtherBonus(0);
        $scaleMail->setStrRequirement(0);
        $scaleMail->setStealthDisadvantage(true);
        $scaleMail->setDonTimeTurns(50);
        $scaleMail->setDoffTimeTurns(10);
        $armors [] = $scaleMail;

        $breastplate = new BaseArmor();
        $breastplate->setBaseItemName('Breastplate');
        $breastplate->setClass(BaseArmor::CLASS_MEDIUM_ARMOR);
        $breastplate->setCostCopper(40000);
        $breastplate->setWeightPounds(20);
        $breastplate->setBaseAC(14);
        $breastplate->setMaxDexBonus(2);
        $breastplate->setOtherBonus(0);
        $breastplate->setStrRequirement(0);
        $breastplate->setStealthDisadvantage(false);
        $breastplate->setDonTimeTurns(50);
        $breastplate->setDoffTimeTurns(10);
        $armors [] = $breastplate;

        $halfPlate = new BaseArmor();
        $halfPlate->setBaseItemName('Half Plate');
        $halfPlate->setClass(BaseArmor::CLASS_MEDIUM_ARMOR);
        $halfPlate->setCostCopper(75000);
        $halfPlate->setWeightPounds(40);
        $halfPlate->setBaseAC(15);
        $halfPlate->setMaxDexBonus(2);
        $halfPlate->setOtherBonus(0);
        $halfPlate->setStrRequirement(0);
        $halfPlate->setStealthDisadvantage(true);
        $halfPlate->setDonTimeTurns(50);
        $halfPlate->setDoffTimeTurns(10);
        $armors [] = $halfPlate;

        $ringMail = new BaseArmor();
        $ringMail->setBaseItemName('Ring Mail');
        $ringMail->setClass(BaseArmor::CLASS_HEAVY_ARMOR);
        $ringMail->setCostCopper(3000);
        $ringMail->setWeightPounds(40);
        $ringMail->setBaseAC(14);
        $ringMail->setMaxDexBonus(0);
        $ringMail->setOtherBonus(0);
        $ringMail->setStrRequirement(0);
        $ringMail->setStealthDisadvantage(true);
        $ringMail->setDonTimeTurns(100);
        $ringMail->setDoffTimeTurns(50);
        $armors [] = $ringMail;

        $chainMail = new BaseArmor();
        $chainMail->setBaseItemName('Chain Mail');
        $chainMail->setClass(BaseArmor::CLASS_HEAVY_ARMOR);
        $chainMail->setCostCopper(7500);
        $chainMail->setWeightPounds(55);
        $chainMail->setBaseAC(16);
        $chainMail->setMaxDexBonus(0);
        $chainMail->setOtherBonus(0);
        $chainMail->setStrRequirement(13);
        $chainMail->setStealthDisadvantage(true);
        $chainMail->setDonTimeTurns(100);
        $chainMail->setDoffTimeTurns(50);
        $armors [] = $chainMail;

        $splint = new BaseArmor();
        $splint->setBaseItemName('Splint Armor');
        $splint->setClass(BaseArmor::CLASS_HEAVY_ARMOR);
        $splint->setCostCopper(20000);
        $splint->setWeightPounds(60);
        $splint->setBaseAC(17);
        $splint->setMaxDexBonus(0);
        $splint->setOtherBonus(0);
        $splint->setStrRequirement(15);
        $splint->setStealthDisadvantage(true);
        $splint->setDonTimeTurns(100);
        $splint->setDoffTimeTurns(50);
        $armors [] = $splint;

        $plate = new BaseArmor();
        $plate->setBaseItemName('Plate Armor');
        $plate->setClass(BaseArmor::CLASS_HEAVY_ARMOR);
        $plate->setCostCopper(150000);
        $plate->setWeightPounds(65);
        $plate->setBaseAC(18);
        $plate->setMaxDexBonus(0);
        $plate->setOtherBonus(0);
        $plate->setStrRequirement(15);
        $plate->setStealthDisadvantage(true);
        $plate->setDonTimeTurns(100);
        $plate->setDoffTimeTurns(50);
        $armors [] = $plate;

        return $armors;
    }

    private function getBaseAmmunitions ()
    {
        $ammunitions = [];

        $arrow = new BaseAmmunition();
        $arrow->setBaseItemName('Arrow');
        $arrow->setWeightPounds(1);
        $arrow->setCostCopper(100);
        $arrow->setBundleSize(20);
        $ammunitions [] = $arrow;

        $needle = new BaseAmmunition();
        $needle->setBaseItemName('Blowgun Needle');
        $needle->setWeightPounds(1);
        $needle->setCostCopper(100);
        $needle->setBundleSize(50);
        $ammunitions [] = $needle;

        /** TODO Do all the ammunitions */



        return $ammunitions;
    }

    private function getWeaponPropertiesAsAbilities ()
    {
        $properties = [];

        $ammunitionArrows = new Ability();
        $ammunitionArrows->setName('Ammunition - Arrows');
        $properties [] = $ammunitionArrows;

        $ammunitionBolts = new Ability();
        $ammunitionBolts->setName('Ammunition - Bolts');
        $properties [] = $ammunitionBolts;

        $ammunitionNeedles = new Ability();
        $ammunitionNeedles->setName('Ammunition - Needles');
        $properties [] = $ammunitionNeedles;

        $ammunitionBullets = new Ability();
        $ammunitionBullets->setName('Ammunition - Bullets');
        $properties [] = $ammunitionBullets;

        $finesse = new Ability();
        $finesse->setName('Finesse');
        $properties [] = $finesse;

        $heavy = new Ability();
        $heavy->setName('Heavy');
        $properties [] = $heavy;

        $light = new Ability();
        $light->setName('Light');
        $properties [] = $light;

        $loading = new Ability();
        $loading->setName('Loading');
        $properties [] = $loading;

        $range515 = new Ability();
        $range515->setName('Range - 5/15');
        $properties [] = $range515;

        $range2060 = new Ability();
        $range2060->setName('Range - 20/60');
        $properties [] = $range2060;

        $range25100 = new Ability();
        $range25100->setName('Range - 25/100');
        $properties [] = $range25100;

        $range30120 = new Ability();
        $range30120->setName('Range - 30/120');
        $properties [] = $range30120;

        $range80320 = new Ability();
        $range80320->setName('Range - 80/320');
        $properties [] = $range80320;

        $range100400 = new Ability();
        $range100400->setName('Range - 100/400');
        $properties [] = $range100400;

        $range150600 = new Ability();
        $range150600->setName('Range - 150/600');
        $properties [] = $range150600;

        $reach = new Ability();
        $reach->setName('Reach');
        $properties [] = $reach;

        /** TODO Special abilities but ugh */

        $thrown = new Ability();
        $thrown->setName('Thrown');
        $properties [] = $thrown;

        $thoHanded = new Ability();
        $thoHanded->setName('Two Handed');
        $properties [] = $thoHanded;

        $versatile1d8 = new Ability();
        $versatile1d8->setName('Versatile - 1d8');
        $properties [] = $versatile1d8;

        $versatile1d10 = new Ability();
        $versatile1d10->setName('Versatile - 1d10');
        $properties [] = $versatile1d10;

        return $properties;
    }

    private function getWeaponPropertyAbilityPartials (ObjectRepository $abilityRepository)
    {
        $propertyPart = [];

        $ammunitionDescription = 'You can use a weapon that has the ammunition property to make a ranged attack only if you have ammunition to fire from the weapon. Each time you attack with the weapon, you expend one piece of ammunition. Drawing the ammunition from a quiver, case, or other container is part of the attack (you need a free hand to load a one-handed weapon). At the end of the battle, you can recover half your expended ammunition by taking a minute to search the battlefield.'.PHP_EOL.'If you use a weapon that has the ammunition property to make a melee attack, you treat the weapon as an improvised weapon. A sling must be loaded to deal any damage when used in this way';
        $finesseDescription = 'When making an attack with a finesse weapon, you use your choice of your Strength or Dexterity modifier for the attack and damage rolls. You must use the same modifier for both rolls.';
        $heavyDescription = 'Small creatures have disadvantage on attack rolls with heavy weapons. A heavy weapon’s size and bulk make it too large for a Small creature to use effectively.';
        $lightDescription = 'A light weapon is small and easy to handle, making it ideal for use when fighting with two weapons.';
        $loadingDescription = 'Because of the time required to load this weapon, you can fire only one piece of ammunition from it when you use an action, bonus action, or reaction to fire it, regardless of the number of attacks you can normally make.';
        $rangeDescription = "A weapon that can be used to make a ranged attack has a range in parentheses after the ammunition or thrown property. The rangelists two numbers. The first is the weapon’s normal range in feet, and the second indicates the weapon’s long range. When attacking a target beyond normal range, you have disadvantage on the attack roll. You can't attack a target beyond the weapon's long range";
        $reachDescription = 'This weapon adds 5 feet to your reach when you attack with it, as well as when determining your reach for opportunity attacks with it.';
        $specialDescription = 'A weapon with the special property has unusual rules governing its use, explained in the weapon’s description (see “Special Weapons” later in this section).';
        $thrownDescription = 'If a weapon has the thrown property, you can throw the weapon to make a ranged attack. If the weapon is a melee weapon, you use the same ability modifier for that attack roll and damage roll that you would use for a melee attack with the weapon. For example, if you throw a handaxe, you use your Strength, but if you throw a dagger, you can use either your Strength or your Dexterity, since the dagger has the finesse property.';
        $twoHandedDescription = 'This weapon requires two hands when you attack with it.';
        $versatileDescription = 'This weapon can be used with one or two hands. A damage value in parentheses appears with the property—the damage when the weapon is used with two hands to make a melee attack.';

        $abilityAmmunitionArrows = $abilityRepository->findOneBy(['name' => 'Ammunition - Arrows']);
        $ammunitionGenericArrow = new AbilityGeneric();
        $ammunitionGenericArrow->setAbility($abilityAmmunitionArrows);
        $ammunitionGenericArrow->setDescription($ammunitionDescription);
        $propertyPart [] = $ammunitionGenericArrow;
        $abilityOverrideArrow = new AbilityOverride();
        $abilityOverrideArrow->setAbility($abilityAmmunitionArrows);
        $abilityOverrideArrow->setOverrideKey('ammunition');
        $abilityOverrideArrow->setValue('Arrow');
        $propertyPart [] = $abilityOverrideArrow;

        $abilityAmmunitionNeedles = $abilityRepository->findOneBy(['name' => 'Ammunition - Needles']);
        $ammunitionGenericNeedle = new AbilityGeneric();
        $ammunitionGenericNeedle->setAbility($abilityAmmunitionNeedles);
        $ammunitionGenericNeedle->setDescription($ammunitionDescription);
        $propertyPart [] = $ammunitionGenericNeedle;
        $abilityOverrideNeedle = new AbilityOverride();
        $abilityOverrideNeedle->setAbility($abilityAmmunitionNeedles);
        $abilityOverrideNeedle->setOverrideKey('ammunition');
        $abilityOverrideNeedle->setValue('Blowgun Needle');
        $propertyPart [] = $abilityOverrideNeedle;

        $abilityAmmunitionBolts = $abilityRepository->findOneBy(['name' => 'Ammunition - Bolts']);
        $ammunitionGenericBolt = new AbilityGeneric();
        $ammunitionGenericBolt->setAbility($abilityAmmunitionBolts);
        $ammunitionGenericBolt->setDescription($ammunitionDescription);
        $propertyPart [] = $ammunitionGenericBolt;
        $abilityOverrideBolt = new AbilityOverride();
        $abilityOverrideBolt->setAbility($abilityAmmunitionBolts);
        $abilityOverrideBolt->setOverrideKey('ammunition');
        $abilityOverrideBolt->setValue('Crossbow Bolt');
        $propertyPart [] = $abilityOverrideBolt;

        $abilityAmmunitionBullets = $abilityRepository->findOneBy(['name' => 'Ammunition - Bullets']);
        $ammunitionGenericBullet = new AbilityGeneric();
        $ammunitionGenericBullet->setAbility($abilityAmmunitionBullets);
        $ammunitionGenericBullet->setDescription($ammunitionDescription);
        $propertyPart [] = $ammunitionGenericBullet;
        $abilityOverrideBullet = new AbilityOverride();
        $abilityOverrideBullet->setAbility($abilityAmmunitionBullets);
        $abilityOverrideBullet->setOverrideKey('ammunition');
        $abilityOverrideBullet->setValue('Sling Bullet');
        $propertyPart [] = $abilityOverrideBullet;

        /**
         * TODO Finesse should probably a custom function return type of method. But since that isn't implemented in the first place, it is not. And that is gonna be a doozy
         */
        $abilityFinesse = $abilityRepository->findOneBy(['name' => 'Finesse']);
        $finesseGeneric = new AbilityGeneric();
        $finesseGeneric->setAbility($abilityFinesse);
        $finesseGeneric->setDescription($finesseDescription);
        $propertyPart [] = $finesseGeneric;

        $abilityHeavy = $abilityRepository->findOneBy(['name' => 'Heavy']);
        $heavyGeneric = new AbilityGeneric();
        $heavyGeneric->setAbility($abilityHeavy);
        $heavyGeneric->setDescription($heavyDescription);
        $propertyPart [] = $heavyGeneric;

        /** TODO Light may also be an override? Then again maybe not. It's existence alone can be a check */
        $abilityLight = $abilityRepository->findOneBy(['name' => 'Light']);
        $lightGeneric = new AbilityGeneric();
        $lightGeneric->setAbility($abilityLight);
        $lightGeneric->setDescription($lightDescription);
        $propertyPart [] = $lightGeneric;

        $loadingAbility = $abilityRepository->findOneBy(['name' => 'Loading']);
        $loadingGeneric = new AbilityGeneric();
        $loadingGeneric->setAbility($loadingAbility);
        $loadingGeneric->setDescription($loadingDescription);
        $propertyPart [] = $loadingGeneric;

        $abilityRange515 = $abilityRepository->findOneBy(['name' => 'Range - 5/15']);
        $rangeGeneric = new AbilityGeneric();
        $rangeGeneric->setAbility($abilityRange515);
        $rangeGeneric->setDescription($rangeDescription);
        $propertyPart [] = $rangeGeneric;
        $abilityOverrideNormal515 = new AbilityOverride();
        $abilityOverrideNormal515->setAbility($abilityRange515);
        $abilityOverrideNormal515->setOverrideKey('range_normal');
        $abilityOverrideNormal515->setValue('5');
        $propertyPart [] = $abilityOverrideNormal515;
        $abilityOverrideDisadvantage515 = new AbilityOverride();
        $abilityOverrideDisadvantage515->setAbility($abilityRange515);
        $abilityOverrideDisadvantage515->setOverrideKey('range_disadvantage');
        $abilityOverrideDisadvantage515->setValue('15');
        $propertyPart [] = $abilityOverrideDisadvantage515;

        $abilityRange2060 = $abilityRepository->findOneBy(['name' => 'Range - 20/60']);
        $rangeGeneric = new AbilityGeneric();
        $rangeGeneric->setAbility($abilityRange2060);
        $rangeGeneric->setDescription($rangeDescription);
        $propertyPart [] = $rangeGeneric;
        $abilityOverrideNormal2060 = new AbilityOverride();
        $abilityOverrideNormal2060->setAbility($abilityRange2060);
        $abilityOverrideNormal2060->setOverrideKey('range_normal');
        $abilityOverrideNormal2060->setValue('20');
        $propertyPart [] = $abilityOverrideNormal2060;
        $abilityOverrideDisadvantage2060 = new AbilityOverride();
        $abilityOverrideDisadvantage2060->setAbility($abilityRange2060);
        $abilityOverrideDisadvantage2060->setOverrideKey('range_disadvantage');
        $abilityOverrideDisadvantage2060->setValue('60');
        $propertyPart [] = $abilityOverrideDisadvantage2060;

        $abilityRange25100 = $abilityRepository->findOneBy(['name' => 'Range - 25/100']);
        $rangeGeneric = new AbilityGeneric();
        $rangeGeneric->setAbility($abilityRange25100);
        $rangeGeneric->setDescription($rangeDescription);
        $propertyPart [] = $rangeGeneric;
        $abilityOverrideNormal25100 = new AbilityOverride();
        $abilityOverrideNormal25100->setAbility($abilityRange25100);
        $abilityOverrideNormal25100->setOverrideKey('range_normal');
        $abilityOverrideNormal25100->setValue('25');
        $propertyPart [] = $abilityOverrideNormal25100;
        $abilityOverrideDisadvantage25100 = new AbilityOverride();
        $abilityOverrideDisadvantage25100->setAbility($abilityRange25100);
        $abilityOverrideDisadvantage25100->setOverrideKey('range_disadvantage');
        $abilityOverrideDisadvantage25100->setValue('100');
        $propertyPart [] = $abilityOverrideDisadvantage25100;

        $abilityRange30120 = $abilityRepository->findOneBy(['name' => 'Range - 30/120']);
        $rangeGeneric = new AbilityGeneric();
        $rangeGeneric->setAbility($abilityRange30120);
        $rangeGeneric->setDescription($rangeDescription);
        $propertyPart [] = $rangeGeneric;
        $abilityOverrideNormal30120 = new AbilityOverride();
        $abilityOverrideNormal30120->setAbility($abilityRange30120);
        $abilityOverrideNormal30120->setOverrideKey('range_normal');
        $abilityOverrideNormal30120->setValue('30');
        $propertyPart [] = $abilityOverrideNormal30120;
        $abilityOverrideDisadvantage30120 = new AbilityOverride();
        $abilityOverrideDisadvantage30120->setAbility($abilityRange30120);
        $abilityOverrideDisadvantage30120->setOverrideKey('range_disadvantage');
        $abilityOverrideDisadvantage30120->setValue('120');
        $propertyPart [] = $abilityOverrideDisadvantage30120;

        $abilityRange80320 = $abilityRepository->findOneBy(['name' => 'Range - 80/320']);
        $rangeGeneric = new AbilityGeneric();
        $rangeGeneric->setAbility($abilityRange80320);
        $rangeGeneric->setDescription($rangeDescription);
        $propertyPart [] = $rangeGeneric;
        $abilityOverrideNormal80320 = new AbilityOverride();
        $abilityOverrideNormal80320->setAbility($abilityRange80320);
        $abilityOverrideNormal80320->setOverrideKey('range_normal');
        $abilityOverrideNormal80320->setValue('80');
        $propertyPart [] = $abilityOverrideNormal80320;
        $abilityOverrideDisadvantage80320 = new AbilityOverride();
        $abilityOverrideDisadvantage80320->setAbility($abilityRange80320);
        $abilityOverrideDisadvantage80320->setOverrideKey('range_disadvantage');
        $abilityOverrideDisadvantage80320->setValue('320');
        $propertyPart [] = $abilityOverrideDisadvantage80320;

        $abilityRange100400 = $abilityRepository->findOneBy(['name' => 'Range - 100/400']);
        $rangeGeneric = new AbilityGeneric();
        $rangeGeneric->setAbility($abilityRange100400);
        $rangeGeneric->setDescription($rangeDescription);
        $propertyPart [] = $rangeGeneric;
        $abilityOverrideNormal100400 = new AbilityOverride();
        $abilityOverrideNormal100400->setAbility($abilityRange100400);
        $abilityOverrideNormal100400->setOverrideKey('range_normal');
        $abilityOverrideNormal100400->setValue('100');
        $propertyPart [] = $abilityOverrideNormal100400;
        $abilityOverrideDisadvantage100400 = new AbilityOverride();
        $abilityOverrideDisadvantage100400->setAbility($abilityRange100400);
        $abilityOverrideDisadvantage100400->setOverrideKey('range_disadvantage');
        $abilityOverrideDisadvantage100400->setValue('400');
        $propertyPart [] = $abilityOverrideDisadvantage100400;

        $abilityRange150600 = $abilityRepository->findOneBy(['name' => 'Range - 150/600']);
        $rangeGeneric = new AbilityGeneric();
        $rangeGeneric->setAbility($abilityRange150600);
        $rangeGeneric->setDescription($rangeDescription);
        $propertyPart [] = $rangeGeneric;
        $abilityOverrideNormal150600 = new AbilityOverride();
        $abilityOverrideNormal150600->setAbility($abilityRange150600);
        $abilityOverrideNormal150600->setOverrideKey('range_normal');
        $abilityOverrideNormal150600->setValue('150');
        $propertyPart [] = $abilityOverrideNormal150600;
        $abilityOverrideDisadvantage150600 = new AbilityOverride();
        $abilityOverrideDisadvantage150600->setAbility($abilityRange150600);
        $abilityOverrideDisadvantage150600->setOverrideKey('range_disadvantage');
        $abilityOverrideDisadvantage150600->setValue('600');
        $propertyPart [] = $abilityOverrideDisadvantage150600;

        $abilityReach = $abilityRepository->findOneBy(['name' => 'Reach']);
        $reachGeneric = new AbilityGeneric();
        $reachGeneric->setAbility($abilityReach);
        $reachGeneric->setDescription($reachDescription);
        $propertyPart [] = $reachGeneric;
        $abilityOverrideReach = new AbilityOverride();
        $abilityOverrideReach->setAbility($abilityReach);
        $abilityOverrideReach->setOverrideKey('range_normal');
        $abilityOverrideReach->setValue(5);
        $abilityOverrideReach->setIsAppend(true);
        $propertyPart [] = $abilityOverrideReach;

        $abilityThrown = $abilityRepository->findOneBy(['name' => 'Thrown']);
        $thrownGeneric = new AbilityGeneric();
        $thrownGeneric->setAbility($abilityThrown);
        $thrownGeneric->setDescription($thrownDescription);
        $propertyPart [] = $thrownGeneric;

        $abilityTwoHanded = $abilityRepository->findOneBy(['name' => 'Two Handed']);
        $twoHandedGeneric = new AbilityGeneric();
        $twoHandedGeneric->setAbility($abilityTwoHanded);
        $twoHandedGeneric->setDescription($twoHandedDescription);
        $propertyPart [] = $twoHandedGeneric;
        $twoHandedOverride = new AbilityOverride();
        $twoHandedOverride->setAbility($abilityTwoHanded);
        $twoHandedOverride->setOverrideKey('hands_required');
        $twoHandedOverride->setValue('2');
        $propertyPart [] = $twoHandedOverride;

        $abilityVersatile8 = $abilityRepository->findOneBy(['name' => 'Versatile - 1d8']);
        $versatile8Generic = new AbilityGeneric();
        $versatile8Generic->setAbility($abilityVersatile8);
        $versatile8Generic->setDescription($versatileDescription);
        $propertyPart [] = $versatile8Generic;
        $versatile8OverrideHands = new AbilityOverride();
        $versatile8OverrideHands->setAbility($abilityVersatile8);
        $versatile8OverrideHands->setOverrideKey('hands_required');
        $versatile8OverrideHands->setValue('2');
        $propertyPart [] = $versatile8OverrideHands;
        $versatile8OverrideDamage = new AbilityOverride();
        $versatile8OverrideDamage->setAbility($abilityVersatile8);
        $versatile8OverrideDamage->setOverrideKey('damage_die_type');
        $versatile8OverrideDamage->setValue('8');
        $propertyPart [] = $versatile8OverrideDamage;

        $abilityVersatile10 = $abilityRepository->findOneBy(['name' => 'Versatile - 1d10']);
        $versatile10Generic = new AbilityGeneric();
        $versatile10Generic->setAbility($abilityVersatile10);
        $versatile10Generic->setDescription($versatileDescription);
        $propertyPart [] = $versatile10Generic;
        $versatile10OverrideHands = new AbilityOverride();
        $versatile10OverrideHands->setAbility($abilityVersatile10);
        $versatile10OverrideHands->setOverrideKey('hands_required');
        $versatile10OverrideHands->setValue('2');
        $propertyPart [] = $versatile8OverrideHands;
        $versatile10OverrideDamage = new AbilityOverride();
        $versatile10OverrideDamage->setAbility($abilityVersatile10);
        $versatile10OverrideDamage->setOverrideKey('damage_die_type');
        $versatile10OverrideDamage->setValue('10');
        $propertyPart [] = $versatile8OverrideDamage;

        return $propertyPart;
    }

    private function getBaseWeapons (ObjectRepository $abilityRepository)
    {
        $baseWeapons = [];

        $club = new BaseWeapon();
        $club->setBaseItemName('Club');
        $club->setCostCopper(10);
        $club->setWeightPounds(2);
        $club->setDamageDieAmount(1);
        $club->setDamageDieType(4);
        $club->setDamageType(BaseWeapon::DAMAGE_BLUDGEONING);
        $club->setClass(BaseWeapon::CLASS_SIMPLE);
        $club->setRanged(false);
        $club->setProperties([
            $abilityRepository->findOneBy(['name' => 'Light'])
        ]);
        $baseWeapons [] = $club;

        return $baseWeapons;
    }
}
