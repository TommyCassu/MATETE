<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Lieu;
use App\Repository\AnnonceRepository;
use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProducteurRepository;

class PanelProdController extends AbstractController
{
    #[Route('/panel/prod', name: 'panel_prod')]
    public function index(ProducteurRepository $producteurRepository, AnnonceRepository $annonceRepository, LieuRepository $lieuRepository): Response
    {
        $lieux = $lieuRepository->findAll();


        $listeAnnonces = [];
        foreach ($lieux as $lieu) {
            foreach ($lieu->getAnnonce() as $annonce) {
                $name = $lieu->getNom();
                $cooX = $lieu->getCooX();
                $cooY = $lieu->getCooY();
                
                $listeAnnonces[] = array(
                    'name' => $name,
                    'cooX'=> $cooX,
                    'cooY' => $cooY
                );
            }
        }

        return $this->render('panel_prod/index.html.twig', [
            'listeAnnonces' => $listeAnnonces,
        ]);
    }
}
