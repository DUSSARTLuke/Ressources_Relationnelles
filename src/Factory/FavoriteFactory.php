<?php

namespace App\Factory;

use App\Entity\Favorite;
use App\Repository\FavoriteRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Favorite>
 *
 * @method static Favorite|Proxy createOne(array $attributes = [])
 * @method static Favorite[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Favorite|Proxy find(object|array|mixed $criteria)
 * @method static Favorite|Proxy findOrCreate(array $attributes)
 * @method static Favorite|Proxy first(string $sortedField = 'id')
 * @method static Favorite|Proxy last(string $sortedField = 'id')
 * @method static Favorite|Proxy random(array $attributes = [])
 * @method static Favorite|Proxy randomOrCreate(array $attributes = [])
 * @method static Favorite[]|Proxy[] all()
 * @method static Favorite[]|Proxy[] findBy(array $attributes)
 * @method static Favorite[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Favorite[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static FavoriteRepository|RepositoryProxy repository()
 * @method Favorite|Proxy create(array|callable $attributes = [])
 */
final class FavoriteFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'user' => UserFactory::random(),
            'resource' => ResourceFactory::random()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Favorite $favorite) {})
            ;
    }

    protected static function getClass(): string
    {
        return Favorite::class;
    }
}
