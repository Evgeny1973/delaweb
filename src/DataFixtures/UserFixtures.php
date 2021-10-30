<?php

namespace App\DataFixtures;

use App\Model\Organization\Entity\Organization;
use App\Model\User\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        
        for ($i = 0; $i < 10; $i++) {
            $user = new User(
                $faker->firstName,
                $faker->lastName,
                $faker->numberBetween(1234567, 7654321),
                $faker->password,
                $faker->numberBetween(1, 10),
                $faker->numberBetween(1, 10),
            );
            
            $manager->persist($user);
        }

        $manager->flush();
    }
    
    public function getDependencies(): array
    {
        return [
            Organization::class,
        ];
    }
}
