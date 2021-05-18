<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase{
    public function testIndex(){
        $client = static::createClient();
        $client->request("GET", "/");

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains("h1", "Richard Benson appreciation page");
    }

    public function testForm(){
        $client = static::createClient();
        $client->followRedirects(true);

        $crawler = $client->request("GET", "/");
        $form = $crawler->selectButton('Leave your message to Richard!')->form();
        $form["comment_form[nickname]"] = "Fabien";
        $form["comment_form[email]"] = "prova@prova.com";
        $form["comment_form[text]"] = "grande richaaaard!";
        $crawler = $client->submit($form);

       //  $this->assertResponseIsSuccessful();
        $html = $crawler->html();
        $this->assertStringContainsString("grande richaaaard!", $html);
    }
}
