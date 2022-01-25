<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\CommentFactory;
use App\Factory\FavoriteFactory;
use App\Factory\ProgressFactory;
use App\Factory\RelationTypeFactory;
use App\Factory\ResourceFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CategoryFactory::new()->createMany(10);
        RelationTypeFactory::new()->createMany(15);
        UserFactory::new()->createMany(100);
        ResourceFactory::new()->createMany(70, ['relationType' => RelationTypeFactory::randomRange(1, 5)]);
        CommentFactory::new()->createMany(25);
        FavoriteFactory::new()->createMany(15);
        ProgressFactory::new()->createMany(25);

        $manager->flush();
    }
}