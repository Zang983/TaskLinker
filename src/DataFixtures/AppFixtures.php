<?php

namespace App\DataFixtures;

use App\Factory\ProjectFactory;
use App\Factory\StatusFactory;
use App\Factory\TaskFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        UserFactory::createMany(20);
        ProjectFactory::createMany(10);
        $statuses = StatusFactory::createMany(3);
        TaskFactory::createMany(80, function() use ($statuses) {
            return ['status' => $statuses[array_rand($statuses)]];
        });
        $manager->flush();
    }
}
