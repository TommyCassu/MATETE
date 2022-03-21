<?php

namespace App\DataFixtures;

use App\Entity\Producteur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $producteur = new Producteur();
        
        $producteur->setNom("nomTest");
        $producteur->setPrenom("prenomTest");
        $producteur->setMail("mailTest@hotmail.fr");
        $producteur->setMdp("toto");
        $producteur->setTel("0615665234");
        
        $manager->persist($producteur);
        $manager->flush();
    }
}
