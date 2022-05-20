<?php

namespace App\Tests\Controller;

use App\DBAL\Types\ResourceStatusType;
use App\DBAL\Types\ResourceType;
use App\DBAL\Types\ResourceVisibilityType;
use App\Entity\Resource;
use App\Repository\ResourceRepository;
use App\Repository\UserRepository;
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

    public function testUpdateResourceAdmin()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/ressources/modifier/5');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $client->request('GET', '/admin/ressources/modifier/5');
        $this->assertResponseIsSuccessful();

        $crawler = $client->request('PUT', '/admin/ressources/modifier/5');
        $this->assertResponseIsSuccessful();

        $buttonCrawlerNode = $crawler->selectButton('resource_admin[Valider]');
        $form = $buttonCrawlerNode->form();
        $form['resource_admin[status]'] = ResourceStatusType::PUBLISHED;
        $form['resource_admin[visibility]'] = ResourceVisibilityType::PUBLIC;
        $client->submit($form);
        $this->assertResponseRedirects('/admin/ressources/list');

    }

    public function testDeleteRessource()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/ressources/delete/5');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $client->request('GET', '/admin/ressources/delete/5');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/admin/ressources/list');

        $userRepository = static::getContainer()->get(ResourceRepository::class);
        $resource = $userRepository->findOneBy([
            'id' => 5
        ]);

        $this->assertEquals(
            'Supprimé',
            $resource->getStatus(),
            "actual value is not equals to expected"
        );

    }

    public function testValidRessource()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/ressources/valid/5');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $client->request('GET', '/admin/ressources/valid/5');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/admin/ressources/list');

        $userRepository = static::getContainer()->get(ResourceRepository::class);
        $resource = $userRepository->findOneBy([
            'id' => 5
        ]);

        $this->assertEquals(
            'Publié',
            $resource->getStatus(),
            "actual value is not equals to expected"
        );

    }

    public function testAddResource()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/ressources/creer');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $crawler = $client->request('GET', '/admin/ressources/creer');
        $this->assertResponseIsSuccessful();

        $buttonCrawlerNode = $crawler->selectButton('create');
        $form = $buttonCrawlerNode->form();
        $form['creation_ressource[content]']->setValue('Test form');
        $form['creation_ressource[name]']->setValue('Test form');
        $form['creation_ressource[category]']->setValue('2');
        $form['creation_ressource[relationType]']->setValue('2');
        $form['creation_ressource[resourceType]']->setValue(ResourceType::getDefaultValue());
        $form['creation_ressource[visibility]']->setValue(ResourceVisibilityType::getDefaultValue());

        $client->submit($form);


        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/admin/ressources/list');

    }

}
