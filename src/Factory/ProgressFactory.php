<?php

namespace App\Factory;

use App\DBAL\Types\ProgressStatusType;
use App\Entity\Progress;
use App\Repository\ProgressRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Progress>
 *
 * @method static Progress|Proxy createOne(array $attributes = [])
 * @method static Progress[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Progress|Proxy find(object|array|mixed $criteria)
 * @method static Progress|Proxy findOrCreate(array $attributes)
 * @method static Progress|Proxy first(string $sortedField = 'id')
 * @method static Progress|Proxy last(string $sortedField = 'id')
 * @method static Progress|Proxy random(array $attributes = [])
 * @method static Progress|Proxy randomOrCreate(array $attributes = [])
 * @method static Progress[]|Proxy[] all()
 * @method static Progress[]|Proxy[] findBy(array $attributes)
 * @method static Progress[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Progress[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProgressRepository|RepositoryProxy repository()
 * @method Progress|Proxy create(array|callable $attributes = [])
 */
final class ProgressFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'status' => self::faker()->randomElement(['NS', 'IP', 'FI']),
            'user' => UserFactory::random(),
            'resource' => ResourceFactory::random()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(Progress $progress) {})
            ;
    }

    protected static function getClass(): string
    {
        return Progress::class;
    }
}
