<?php

namespace App\Tests\Controller;

use App\Tests\LoggedUser;

class RessourcesControllerTest extends LoggedUser
{
    public function testVoirMesRessources()
    {
        $client = static::createClient();

        $client->request('GET', '/ressources/list_ressources');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logUser($client);
        $client->request('GET', '/ressources/list_ressources');
        $this->assertResponseIsSuccessful();

        $client->request('PUT', '/ressources/list_ressources');
        $this->assertResponseIsSuccessful();

    }

}
