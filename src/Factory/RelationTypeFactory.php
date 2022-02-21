<?php

namespace App\Factory;

use App\Entity\RelationType;
use App\Repository\RelationTypeRepository;
use Doctrine\Persistence\ObjectManager;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<RelationType>
 *
 * @method static RelationType|Proxy createOne(array $attributes = [])
 * @method static RelationType[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static RelationType|Proxy find(object|array|mixed $criteria)
 * @method static RelationType|Proxy findOrCreate(array $attributes)
 * @method static RelationType|Proxy first(string $sortedField = 'id')
 * @method static RelationType|Proxy last(string $sortedField = 'id')
 * @method static RelationType|Proxy random(array $attributes = [])
 * @method static RelationType|Proxy randomOrCreate(array $attributes = [])
 * @method static RelationType[]|Proxy[] all()
 * @method static RelationType[]|Proxy[] findBy(array $attributes)
 * @method static RelationType[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static RelationType[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RelationTypeRepository|RepositoryProxy repository()
 * @method RelationType|Proxy create(array|callable $attributes = [])
 */
final class RelationTypeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createRelationType(ObjectManager $manager)
    {
        $relationTypes = [
            [
                'id' => 1,
                'name' => 'Soi'
            ],
            [
                'id' => 2,
                'name' => 'Conjoints'
            ],
            [
                'id' => 3,
                'name' => 'Famille : enfants / parents / fratrie'
            ],
            [
                'id' => 4,
                'name' => 'Professionnelle : collègues, collaborateurs et managers'
            ],
            [
                'id' => 5,
                'name' => 'Amis et communautés'
            ],
            [
                'id' => 6,
                'name' => 'Inconnus'
            ],
        ];

        foreach ($relationTypes as $relationType){
            $type = new RelationType();
            $type
                ->setName($relationType['name']);
            $manager->persist($type);
        }
        $manager->flush();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realTextBetween(15, 30, 1),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(RelationType $relationType) {})
        ;
    }

    protected static function getClass(): string
    {
        return RelationType::class;
    }
}
