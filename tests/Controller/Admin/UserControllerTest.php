<?php

namespace App\Tests\Controller;

use App\Tests\LoggedUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends LoggedUser
{
    public function testUserList()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/utilisateurs/list');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logSuperAdmin($client);
        $client->request('GET', '/admin/utilisateurs/list');
        $this->assertResponseIsSuccessful();
    }

    public function testUpdateRoleUser()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/utilisateurs/modifier-role/3');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logSuperAdmin($client);
        $crawler = $client->request('GET', '/admin/utilisateurs/modifier-role/3');
        $this->assertResponseIsSuccessful();

        $buttonCrawlerNode = $crawler->selectButton('form[save]');
        $form = $buttonCrawlerNode->form();

        $form['form[roles][0]']->untick();
        $form['form[roles][1]']->tick();
        $client->submit($form);
        $this->assertResponseRedirects('/admin/utilisateurs/list');

    }

    public function testUpdateIsActiveUser()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/utilisateurs/activate/3');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $crawler = $client->request('GET', '/admin/utilisateurs/activate/3');
        $this->assertResponseIsSuccessful();

        $buttonCrawlerNode = $crawler->selectButton('form[save]');
        $form = $buttonCrawlerNode->form();

        $form['form[isActive]']->untick();
        $client->submit($form);
        $this->assertResponseRedirects('/admin/utilisateurs/list');
    }

}
