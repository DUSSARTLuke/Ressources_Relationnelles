<?php

namespace App\Factory;

use App\DBAL\Types\ResourceStatusType;
use App\Entity\RelationType;
use App\Entity\Resource;
use App\Repository\ResourceRepository;
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
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realTextBetween(15, 75, 1),
            'content' => self::faker()->realTextBetween(150, 600),
            'status' => self::faker()->randomElement(['CR', 'WA', 'PU', 'DE']),
            'category' => CategoryFactory::random(),
            'resourceType' => self::faker()->randomElement(['GA', 'AR', 'CH', 'PC', 'WO', 'RS', 'OG', 'VI']),
            'createdBy' => UserFactory::random(),
            'relationType' => RelationTypeFactory::random()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Resource $resource) {})
        ;
    }

    protected static function getClass(): string
    {
        return Resource::class;
    }
}
