<?php

namespace App\Tests;

use App\Repository\ProducteurRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConnexionTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $producteurRepository = static::getContainer()->get(ProducteurRepository::class);

        $testUser = $producteurRepository->findOneByMail("mailTest@hotmail.fr");

        $client->loginUser($testUser);
        $client = $client->request('GET', '/panel/annonce/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Ajouter un annonce');
    }
    public function testErreur401(): void
    {
        $client = static::createClient();
        $client = $client->request('GET', '/panel/annonce/new');

        $this->assertResponseStatusCodeSame(401);
    }
}
