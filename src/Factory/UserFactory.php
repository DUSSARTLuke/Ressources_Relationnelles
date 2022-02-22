<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<User>
 *
 * @method static User|Proxy createOne(array $attributes = [])
 * @method static User[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static User|Proxy find(object|array|mixed $criteria)
 * @method static User|Proxy findOrCreate(array $attributes)
 * @method static User|Proxy first(string $sortedField = 'id')
 * @method static User|Proxy last(string $sortedField = 'id')
 * @method static User|Proxy random(array $attributes = [])
 * @method static User|Proxy randomOrCreate(array $attributes = [])
 * @method static User[]|Proxy[] all()
 * @method static User[]|Proxy[] findBy(array $attributes)
 * @method static User[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static User[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method User|Proxy create(array|callable $attributes = [])
 */
final class UserFactory extends ModelFactory
{

    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        parent::__construct();
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function createUsers(ObjectManager $manager)
    {
        $users = [
            [
                'username' => 'lukeCesi',
                'email' => 'luke.dussart@viacesi.fr',
                'address1' => "28 rue Jean Jaurès",
                'postalCode' => '34790',
                'city' => 'Grabels',
                'birthday' => new \DateTime('28-10-1999 00:00:00'),
                'roles' => ['ROLE_USER'],
                'password' => 'test',
                'isActive' => 'true',
            ],
            [
                'username' => 'MatteoCesi',
                'email' => 'matteo.menand@viacesi.fr',
                'address1' => "28 rue Jean Jaurès",
                'postalCode' => '26000',
                'city' => 'Valence',
                'birthday' => new \DateTime('20-12-1999 00:00:00'),
                'roles' => ['ROLE_USER'],
                'password' => 'test',
                'isActive' => 'true',
            ],
            [
                'username' => 'jenniferCesi',
                'email' => 'jennifer.cavaccuiti@viacesi.fr',
                'address1' => "28 rue Jean Jaurès",
                'postalCode' => '34000',
                'city' => 'Montpellier',
                'birthday' => new \DateTime('12-05-1985 00:00:00'),
                'roles' => ['ROLE_USER'],
                'password' => 'test',
                'isActive' => 'true',
            ],
            [
                'username' => 'testCesi',
                'email' => 'luke.dussart@viacesi.fr',
                'address1' => "28 rue Jean Jaurès",
                'postalCode' => '34790',
                'city' => 'Grabels',
                'birthday' => new \DateTime('28-10-1999 00:00:00'),
                'roles' => ['ROLE_USER'],
                'password' => 'test',
                'isActive' => 'true',
            ],
        ];

        foreach ($users as $user) {
            $this->createUser($user, $manager);
        }
    }

    private function createUser(array $user, ObjectManager $manager)
    {
        $userReturn = new User();

        $userReturn
            ->setUsername($user['username'])
            ->setEmail($user['email'])
            ->setAddress1($user['address1'])
            ->setPostalCode($user['postalCode'])
            ->setCity($user['city'])
            ->setBirthday($user['birthday'])
            ->setRoles($user['roles'])
            ->setPassword($this->userPasswordEncoder->encodePassword($userReturn, $user['password']))
            ->setConfPassword($this->userPasswordEncoder->encodePassword($userReturn, $user['password']))
            ->setIsActive($user['isActive'])
            ->setIsRGPD(true);

        $manager->persist($userReturn);
        $manager->flush($userReturn);
    }

    protected function getDefaults(): array
    {
        return [
            'username' => self::faker()->userName(),
            'email' => self::faker()->email(),
            'address1' => self::faker()->streetAddress(),
            'postalCode' => substr(self::faker()->postcode(), 0, 5),
            'city' => self::faker()->city(),
            'birthday' => self::faker()->dateTime(),
            'roles' => ['ROLE_USER'],
            'password' => self::faker()->sha256(),
            'isActive' => self::faker()->boolean(),
            'isRGPD' => true,
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(User $user) {})
            ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}
