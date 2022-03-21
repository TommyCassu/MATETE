<?php

namespace App\Tests;

use App\Entity\Annonce;
use PHPUnit\Framework\TestCase;

class AnnonceTest extends TestCase
{
    public function testAssertTrue(): void
    {
        $annonce = new Annonce();
        $annonce->setLibelleProduit("Mon libelle de Produit");
        $annonce->setPrixUnitaire(10);
        $annonce->setQuantite(20);

        $this->assertTrue($annonce->getLibelleProduit()==="Mon libelle de Produit");
        $this->assertTrue($annonce->getPrixUnitaire()===10.0);
        $this->assertTrue($annonce->getQuantite()===20);
    }
    public function testAssertFalse(): void
    {
        $annonce = new Annonce();
        $this->assertFalse($annonce->getLibelleProduit()==='Mon libelle de Produit',"Test du libelle");
        $this->assertFalse($annonce->getPrixUnitaire()===10,"Test du prixUnitaire");
        $this->assertFalse($annonce->getQuantite()===10,"Test de la Quantite");
    }
    public function testAssertEmpty(): void
    {
        $annonce = new Annonce();
        $this->assertEmpty($annonce->getLibelleProduit(),"Test du Libelle");
        $this->assertEmpty($annonce->getPrixUnitaire(),"Test du Prix");
        $this->assertEmpty($annonce->getQuantite(),"Test de la Quantite");
    }
}
