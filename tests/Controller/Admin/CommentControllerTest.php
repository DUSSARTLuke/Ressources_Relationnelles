<?php

namespace App\Tests\Controller;


use App\DBAL\Types\CommentStatusType;
use App\Entity\Comment;
use App\Form\admin\CommentType;
use App\Repository\ResourceRepository;
use App\Repository\UserRepository;
use App\Tests\LoggedUser;

class CommentControllerTest extends LoggedUser
{
    public function testAdminCommentList()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/commentaires/list');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logAdmin($client);
        $client->request('GET', '/admin/commentaires/list');
        $this->assertResponseIsSuccessful();

// TODO cet appel plante allowed memory size exceded
    }

    public function testUserCommentList()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/commentaires/utilisateur-commentaires');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/login');

        $this->logUser($client);
        $client->request('GET', '/admin/commentaires/utilisateur-commentaires');
        $this->assertResponseStatusCodeSame(403);
        // TODO manque la redirection dans le code et ici

        $this->logAdmin($client);
        $client->request('GET', '/admin/commentaires/utilisateur-commentaires');
        $this->assertResponseIsSuccessful();

        $this->logModerator($client);
        $client->request('GET', '/admin/commentaires/utilisateur-commentaires');
        $this->assertResponseIsSuccessful();
    }

//    // TODO celle là n'est pas comptée dans le codecoverage
//    public function testCreateComment() {
//        $client = static::createClient();
//
//        $client->request('POST', '/admin/commentaires/ajouter-un-commentaire');
//        $this->assertResponseStatusCodeSame(302);
//        $this->assertResponseRedirects();
//        $this->assertResponseRedirects('/login');
//
//        $this->logAdmin($client);
//        $crawler = $client->request('POST', '/admin/commentaires/ajouter-un-commentaire');
//        $this->assertResponseIsSuccessful();
//
//        $buttonCrawlerNode = $crawler->selectButton('comment[save]');
//        $form = $buttonCrawlerNode->form();
//        $form['comment[content]']->setValue('Fabien');
//
//        $userRepository = static::getContainer()->get(UserRepository::class);
//        $testUser = $userRepository->findOneBy([
//            'username' => "testUser"
//        ]);
//
//        $form['comment[user]']->setValue('2');
//
////        $form['comment[resource]']->setValue('10');
//
//
//        $client->submit($form);
//        $this->assertResponseIsSuccessful();
//        $this->assertResponseRedirects('/login');
//
//    }

    public function testUpdateComment() {
        $client = static::createClient();

        $client->request('PUT', '/admin/commentaires/modifier-un-commentaire/3');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects();
        $this->assertResponseRedirects('/login');

        $this->logModerator($client);
        $crawler = $client->request('PUT', '/admin/commentaires/modifier-un-commentaire/3');
        $this->assertResponseIsSuccessful();

        $buttonCrawlerNode = $crawler->selectButton('comment[save]');
        $form = $buttonCrawlerNode->form();
        $form['comment[status]'] = CommentStatusType::PUBLISHED;
        $client->submit($form);
        $this->assertResponseRedirects('/admin/commentaires/list');
    }

    public function testDeleteComment() {
        $client = static::createClient();

        $client->request('DELETE', '/admin/commentaires/supprimer-un-commentaire/2');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects();
        $this->assertResponseRedirects('/login');

        $this->logModerator($client);
        $crawler = $client->request('DELETE', '/admin/commentaires/supprimer-un-commentaire/2');
        $this->assertResponseStatusCodeSame(302);
        $this->assertResponseRedirects('/admin/commentaires/list');
    }

}
