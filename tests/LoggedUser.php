<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoggedUser extends WebTestCase
{

    public function logModerator($client)
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy([
            'username' => "testMode"
        ]);

        $client->loginUser($testUser);
    }

    public function logAdmin($client)
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy([
            'username' => "testAdmin"
        ]);

        $client->loginUser($testUser);
    }

    public function logSuperAdmin($client)
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy([
            'username' => "testSuperAdmin"
        ]);

        $client->loginUser($testUser);
    }

    public function logUser($client)
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy([
            'username' => "testUser"
        ]);

        $client->loginUser($testUser);
    }

    public function logWrongUser($client)
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy([
            'username' => "wrongUser"
        ]);

        $client->loginUser($testUser);
    }

}
