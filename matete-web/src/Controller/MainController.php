<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Lieu;
use App\Repository\AnnonceRepository;
use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_page')]
    public function index(AnnonceRepository $annonceRepository, LieuRepository $lieuRepository): Response
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

        return $this->render('main/index.html.twig', [
            'listeAnnonces' => $listeAnnonces,
        ]);
    }
}
