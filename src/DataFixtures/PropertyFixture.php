<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 100; $i++) {
            $property = new Property();
            $property->setTitle($faker->words(3, true));
            $property->setDescription($faker->words(30, true));
            $property->setSurface($faker->numberBetween(20, 350));
            $property->setRooms($faker->numberBetween(2, 10));
            $property->setBedrooms($faker->numberBetween(1, 9));
            $property->setFloor($faker->numberBetween(0, 15));
            $property->setPrice($faker->numberBetween(10000, 1000000));
            $property->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1));
            $property->setCity($faker->city);
            $property->setAdress($faker->address);
            $property->setPostalCode($faker->postcode);
            $property->setSold(false);
            $manager->persist($property);
        }
        $manager->flush();
    }
}
