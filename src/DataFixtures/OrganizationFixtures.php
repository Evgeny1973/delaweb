<?php

namespace App\DataFixtures;

use App\Model\Organization\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrganizationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        
        for ($i = 0; $i < 10; $i++) {
        $organization = new Organization($faker->company);
        
        $manager->persist($organization);
        }

        $manager->flush();
    }
}
