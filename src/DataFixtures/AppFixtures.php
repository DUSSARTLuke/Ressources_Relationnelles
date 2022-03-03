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
        CategoryFactory::new()->createCategory($manager);
        RelationTypeFactory::new()->createRelationType($manager);
        UserFactory::new()->createUsers($manager);
        ResourceFactory::new()->createMany(70, ['relationType' => RelationTypeFactory::randomRange(1, 5)]);
        UserFactory::new()->createUsersAdmin($manager);
        CommentFactory::new()->createMany(25);
        FavoriteFactory::new()->createMany(15);
        ProgressFactory::new()->createMany(25);


        $manager->flush();
    }
}
