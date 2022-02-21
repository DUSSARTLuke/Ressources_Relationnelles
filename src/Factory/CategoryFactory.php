<?php

namespace App\Factory;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ObjectManager;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Category>
 *
 * @method static Category|Proxy createOne(array $attributes = [])
 * @method static Category[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Category|Proxy find(object|array|mixed $criteria)
 * @method static Category|Proxy findOrCreate(array $attributes)
 * @method static Category|Proxy first(string $sortedField = 'id')
 * @method static Category|Proxy last(string $sortedField = 'id')
 * @method static Category|Proxy random(array $attributes = [])
 * @method static Category|Proxy randomOrCreate(array $attributes = [])
 * @method static Category[]|Proxy[] all()
 * @method static Category[]|Proxy[] findBy(array $attributes)
 * @method static Category[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Category[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CategoryRepository|RepositoryProxy repository()
 * @method Category|Proxy create(array|callable $attributes = [])
 */
final class CategoryFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }
    public function createCategory(ObjectManager $manager)
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Communication'
            ],
            [
                'id' => 2,
                'name' => 'Cultures'
            ],
            [
                'id' => 3,
                'name' => 'Développement personnel'
            ],
            [
                'id' => 4,
                'name' => 'Intelligence émotionnelle'
            ],
            [
                'id' => 5,
                'name' => 'Loisirs'
            ],
            [
                'id' => 6,
                'name' => 'Monde professionnel'
            ],
            [
                'id' => 7,
                'name' => 'Parentalité'
            ],
            [
                'id' => 8,
                'name' => 'Qualité de vie'
            ],
            [
                'id' => 9,
                'name' => 'Recherche de sens'
            ],
            [
                'id' => 10,
                'name' => 'Santé physique'
            ],
            [
                'id' => 11,
                'name' => 'Santé psychique'
            ],
            [
                'id' => 12,
                'name' => 'Spiritualité'
            ],
            [
                'id' => 13,
                'name' => 'Vie affective'
            ],
        ];

        foreach ($categories as $category){
            $cat = new Category();
            $cat
                ->setName($category['name']);
            $manager->persist($cat);
        }
        $manager->flush();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realTextBetween(15, 45, 1),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Category $category) {})
        ;
    }

    protected static function getClass(): string
    {
        return Category::class;
    }
}
