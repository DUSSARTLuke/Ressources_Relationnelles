<?php

namespace App\Tests\Controller;

use App\Tests\LoggedUser;

class ResourceControllerTest extends LoggedUser
{
    public function testAdminResourceList()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/ressources/list');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $client->request('GET', '/admin/ressources/list');
        $this->assertResponseIsSuccessful();
    }

    public function testConsultRessources()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/ressources/consult/3');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $client->request('GET', '/admin/ressources/consult/3');
        $this->assertResponseIsSuccessful();
    }

    public function testAdminResourceValidationList()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/ressources/valider');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $client->request('GET', '/admin/ressources/valider');
        $this->assertResponseIsSuccessful();

    }

//    public function testUpdateResourceAdmin()
//    {
//
//    }
//
//    public function testDeleteRessource()
//    {
//
//    }
//
//    public function testValidRessource()
//    {
//
//    }
//
//    public function testAddResource()
//    {
//
//    }

}
