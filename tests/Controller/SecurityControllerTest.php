<?php

namespace App\Tests\Controller;

use App\Tests\LoggedUser;

class SecurityControllerTest extends LoggedUser
{

    public function testLogin()
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
//        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->filter('.login-form')->form([
            'username' => 'testMode',
            'password' => 'test'
        ]);

        $result = $client->submit($form);

        $this->assertResponseRedirects();
        $client->followRedirect();
//        $this->assertResponseRedirects('/');
//        dump($result);

//                $client->submitForm('Submit', [
//                        'comment_form[author]' => 'Fabien',
//                        'comment_form[text]' => 'Some feedback from an automated functional test',
//                        'comment_form[email]' => 'me@automat.ed',
//                        'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/under-construction.gif',
//                    ]);
//                $this->assertResponseRedirects();
    }

//    public function testLogout()
//    {
//
//    }
//
//    public function testMdpOublie()
//    {
//
//    }
//
//    public function testResetPassword()
//    {
//
//    }

}
