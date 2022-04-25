<?php

namespace App\Factory;

use App\DBAL\Types\ResourceStatusType;
use App\Entity\RelationType;
use App\Entity\Resource;
use App\Repository\CategoryRepository;
use App\Repository\RelationTypeRepository;
use App\Repository\ResourceRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Resource>
 *
 * @method static Resource|Proxy createOne(array $attributes = [])
 * @method static Resource[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Resource|Proxy find(object|array|mixed $criteria)
 * @method static Resource|Proxy findOrCreate(array $attributes)
 * @method static Resource|Proxy first(string $sortedField = 'id')
 * @method static Resource|Proxy last(string $sortedField = 'id')
 * @method static Resource|Proxy random(array $attributes = [])
 * @method static Resource|Proxy randomOrCreate(array $attributes = [])
 * @method static Resource[]|Proxy[] all()
 * @method static Resource[]|Proxy[] findBy(array $attributes)
 * @method static Resource[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Resource[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ResourceRepository|RepositoryProxy repository()
 * @method Resource|Proxy create(array|callable $attributes = [])
 */
final class ResourceFactory extends ModelFactory
{
    private $relRepo;
    private $catRepo;
    private $uRepo;

    public function __construct(RelationTypeRepository $relRepo, CategoryRepository $catRepo, UserRepository $uRepo)
    {
        parent::__construct();
        $this->relRepo = $relRepo;
        $this->catRepo = $catRepo;
        $this->uRepo = $uRepo;
    }


    public function createRessourcesPU(ObjectManager $manager): void
    {
        $ressources = [
            // publique
            //catégorie 1
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 1,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 1,
                'resourceType' => 'PC',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 1,
                'resourceType' => 'AR',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 1,
                'resourceType' => 'CH',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez compliqué.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 1,
                'resourceType' => 'OG',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            //catégorie 2
            [
                'name' => 'Test vidéo',
                'content' => "Je suis ici pour vous parler d'une vidéo assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 2,
                'resourceType' => 'VI',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 2,
                'resourceType' => 'PC',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 2,
                'resourceType' => 'AR',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 2,
                'resourceType' => 'WO',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez compliqué.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 2,
                'resourceType' => 'RS',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 3
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 3,
                'resourceType' => 'CH',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 3,
                'resourceType' => 'CH',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 3,
                'resourceType' => 'CH',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 3,
                'resourceType' => 'AR',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 3,
                'resourceType' => 'PC',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 4
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 4,
                'resourceType' => 'WO',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 4,
                'resourceType' => 'VI',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 4,
                'resourceType' => 'GA',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 4,
                'resourceType' => 'CH',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 4,
                'resourceType' => 'CH',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 5
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 5,
                'resourceType' => 'VI',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 5,
                'resourceType' => 'GA',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 5,
                'resourceType' => 'WO',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 5,
                'resourceType' => 'AR',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 5,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 6
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 6,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 6,
                'resourceType' => 'GA',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 6,
                'resourceType' => 'GA',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 6,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 6,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 7
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 7,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 7,
                'resourceType' => 'GA',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 7,
                'resourceType' => 'GA',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 7,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 7,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 8
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 8,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 8,
                'resourceType' => 'GA',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 8,
                'resourceType' => 'GA',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 8,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 8,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 9
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 9,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 9,
                'resourceType' => 'GA',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 9,
                'resourceType' => 'GA',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 9,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 9,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 10
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 10,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 10,
                'resourceType' => 'GA',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 10,
                'resourceType' => 'GA',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 10,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 10,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégori 11
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 11,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 11,
                'resourceType' => 'GA',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 11,
                'resourceType' => 'GA',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 11,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 11,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
            // catégorie 12
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 12,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test fichier',
                'content' => "Je suis ici pour vous parler d'un fichier qui est upload.",
                'status' => 'PU',
                'visibility' => 'SH',
                'category' => 12,
                'resourceType' => 'GA',
                'createdBy' => 2,
                'relationType' => [1,2,3,5,6]
            ],
            [
                'name' => 'Test activité',
                'content' => "Je suis ici pour vous parler d'une activité assez simple.",
                'status' => 'PU',
                'visibility' => 'PRI',
                'category' => 12,
                'resourceType' => 'GA',
                'createdBy' => 3,
                'relationType' => [1,2,6]
            ],
            [
                'name' => 'Nouveauté',
                'content' => "Je suis ici pour vous parler d'une chose assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 12,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [3,5,6]
            ],
            [
                'name' => 'Test jeu',
                'content' => "Je suis ici pour vous parler d'un jeu assez simple.",
                'status' => 'PU',
                'visibility' => 'PUB',
                'category' => 12,
                'resourceType' => 'GA',
                'createdBy' => 1,
                'relationType' => [5,6]
            ],
        ];

        foreach ($ressources as $ressource) {
            $this->createRessource($ressource, $manager);
        }
    }

    private function createRessource(array $ressource, ObjectManager $manager): void
    {
        $ressourceReturn = new Resource();

        $ressourceReturn
            ->setName($ressource['name'])
            ->setContent($ressource['content'])
            ->setStatus($ressource['status'])
            ->setVisibility($ressource['visibility'])
            ->setCategory($this->catRepo->find($ressource['category']))
            ->setResourceType($ressource['resourceType'])
            ->setCreatedBy($this->uRepo->find($ressource['createdBy']));


        foreach ($ressource['relationType'] as $rel) {
            $ressourceReturn->addRelationType($this->relRepo->find($rel));
        }
        $manager->persist($ressourceReturn);
        $manager->flush($ressourceReturn);
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realTextBetween(15, 75, 1),
            'content' => self::faker()->realTextBetween(150, 600),
            'status' => self::faker()->randomElement(['WA', 'PU', 'SU', 'DE']),
            'visibility' => self::faker()->randomElement(['PUB', 'PRI', 'SH']),
            'category' => CategoryFactory::random(),
            'resourceType' => self::faker()->randomElement(['GA', 'AR', 'CH', 'PC', 'WO', 'RS', 'OG', 'VI']),
            'createdBy' => UserFactory::random(),
            'relationType' => RelationTypeFactory::random()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Resource $resource) {})
            ;
    }

    protected static function getClass(): string
    {
        return Resource::class;
    }
}
