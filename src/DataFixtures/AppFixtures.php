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
        $manager->flush();

        UserFactory::new()->createUsers($manager);
        ResourceFactory::new()->createRessourcesPU($manager);
        ResourceFactory::new()->createRessourcesWA($manager);
        ResourceFactory::new()->createRessourcesSU($manager);
        ResourceFactory::new()->createRessourcesDE($manager);
//        ResourceFactory::new()->createMany(70, ['relationType' => RelationTypeFactory::randomRange(1, 5)]);
        CommentFactory::new()->createCommentairesParents($manager);
        CommentFactory::new()->createCommentairesFils($manager);

        FavoriteFactory::new()->createMany(15);
        ProgressFactory::new()->createMany(25);

        UserFactory::new()->createUsersAdmin($manager);



        $manager->flush();
    }
}
