<?php

namespace App\Factory;

use App\DBAL\Types\CommentStatusType;
use App\Entity\Comment;
use App\Entity\User;
use App\Repository\CommentRepository;
use Doctrine\Persistence\ObjectManager;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Comment>
 *
 * @method static Comment|Proxy createOne(array $attributes = [])
 * @method static Comment[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Comment|Proxy find(object|array|mixed $criteria)
 * @method static Comment|Proxy findOrCreate(array $attributes)
 * @method static Comment|Proxy first(string $sortedField = 'id')
 * @method static Comment|Proxy last(string $sortedField = 'id')
 * @method static Comment|Proxy random(array $attributes = [])
 * @method static Comment|Proxy randomOrCreate(array $attributes = [])
 * @method static Comment[]|Proxy[] all()
 * @method static Comment[]|Proxy[] findBy(array $attributes)
 * @method static Comment[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Comment[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CommentRepository|RepositoryProxy repository()
 * @method Comment|Proxy create(array|callable $attributes = [])
 */
final class CommentFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createCommentairesParents(ObjectManager $manager)
    {
        $comments = [];
        for($i=0; $i< 25; $i++){
            $comments[] = $this->getDefaults();
        }

        foreach ($comments as $comment){
            $this->createComment($comment, $manager);
        }
    }

    public function createCommentairesFils(ObjectManager $manager)
    {
        $comments = [
            [
                'content' => self::faker()->realText,
                'status' => self::faker()->randomElement(['WA', 'PU', 'DE']),
                'user' => UserFactory::random()->object(),
                'resource' => ResourceFactory::random()->object(),
                'parent' => self::random()->object()
            ],
            [
                'content' => self::faker()->realText,
                'status' => self::faker()->randomElement(['WA', 'PU', 'DE']),
                'user' => UserFactory::random()->object(),
                'resource' => ResourceFactory::random()->object(),
                'parent' => self::random()->object()
            ],
            [
                'content' => self::faker()->realText,
                'status' => self::faker()->randomElement(['WA', 'PU', 'DE']),
                'user' => UserFactory::random()->object(),
                'resource' => ResourceFactory::random()->object(),
                'parent' => self::random()->object()
            ],
            [
                'content' => self::faker()->realText,
                'status' => self::faker()->randomElement(['WA', 'PU', 'DE']),
                'user' => UserFactory::random()->object(),
                'resource' => ResourceFactory::random()->object(),
                'parent' => self::random()->object()
            ],
            [
                'content' => self::faker()->realText,
                'status' => self::faker()->randomElement(['WA', 'PU', 'DE']),
                'user' => UserFactory::random()->object(),
                'resource' => ResourceFactory::random()->object(),
                'parent' => self::random()->object()
            ],
            [
                'content' => self::faker()->realText,
                'status' => self::faker()->randomElement(['WA', 'PU', 'DE']),
                'user' => UserFactory::random()->object(),
                'resource' => ResourceFactory::random()->object(),
                'parent' => self::random()->object()
            ],
            [
                'content' => self::faker()->realText,
                'status' => self::faker()->randomElement(['WA', 'PU', 'DE']),
                'user' => UserFactory::random()->object(),
                'resource' => ResourceFactory::random()->object(),
                'parent' => self::random()->object()
            ],

        ];

        foreach ($comments as $comment){
            $this->createComment($comment, $manager);
        }
    }


    public function createComment(array $comment, ObjectManager $manager)
    {
        $commentReturn = new Comment();
//        dd($comment);

        $commentReturn
            ->setContent($comment['content'])
            ->setResource($comment['resource'])
            ->setUser($comment['user'])
            ->setStatus($comment['status']);

        if(isset($comment['parent'])){
            $commentReturn->setParent($comment['parent']);
        }

        $manager->persist($commentReturn);
        $manager->flush($commentReturn);
    }

    protected function getDefaults(): array
    {
        return [
            'content' => self::faker()->realText,
            'status' => self::faker()->randomElement(['WA', 'PU', 'DE']),
            'user' => UserFactory::random()->object(),
            'resource' => ResourceFactory::random()->object()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this;
    }

    protected static function getClass(): string
    {
        return Comment::class;
    }
}
