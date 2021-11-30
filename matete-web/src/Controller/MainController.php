<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Lieu;
use App\Repository\AnnonceRepository;
use App\Repository\LieuRepository;
use App\Repository\ProducteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_page')]
    public function index(AnnonceRepository $annonceRepository, LieuRepository $lieuRepository, ProducteurRepository $producteurRepository): Response
    {
        $user = $this->getUser();
        $lieux = $lieuRepository->findAll();
        $producteur = $producteurRepository->find($this->getUser());


        $listeAnnonces = [];
        foreach ($lieux as $lieu) {
            foreach ($lieu->getAnnonce() as $annonce) {
                $name = $annonce->getNom();
                $cooX = $annonce->getCooX();
                $cooY = $annonce->getCooY();
                
                $listeAnnonces[] = array(
                    'name' => $name,
                    'cooX'=> $cooX,
                    'cooY' => $cooY
                );
            }
        }

        // Afficher le tableau des annonces
        $listeDesAnnonces = [];
        foreach ($producteur->getAnnonce() as $annonce) {
            $libelle = $annonce->getLibelleProduit();
            $creneauxDebut = $annonce->getCreneauxDebut();
            $creneauxFin = $annonce->getCreneauxFin();
            $prixUnitaire = $annonce->getPrixUnitaire();
            $quantite = $annonce->getQuantite();
            $status = $annonce->getStatus();
            $dateMiseEnLigne = $annonce->getDateMiseEnLigne();
            $id = $annonce->getId();
                
                $listeDesAnnonces[] = array(
                    'id' => $id,
                    'libelle' => $libelle,
                    'cDebut' => $creneauxDebut,
                    'cFin' => $creneauxFin,
                    'status' => $status,
                    'date' => $dateMiseEnLigne
                );
        }

        dump($listeDesAnnonces);

        if($user == null){
            return $this->render('main/index.html.twig', [
                'listeAnnonces' => $listeAnnonces,
            ]);
        }else{
            return $this->render('panel_prod/index.html.twig', [
                'listeAnnonces' => $listeAnnonces,
                'tableauAnnonce' => $listeDesAnnonces,

            ]);
        }
    }
}
