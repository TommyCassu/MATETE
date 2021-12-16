<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Lieu;
use App\Repository\AnnonceRepository;
use App\Repository\LieuRepository;
use App\Repository\ProducteurRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_page')]
    public function index(AnnonceRepository $annonceRepository, LieuRepository $lieuRepository, ProducteurRepository $producteurRepository): Response
    {
        $session = new Session();
        $session->start();

        dump($session->get('panier'));

        $user = $this->getUser();
        $lieux = $lieuRepository->findAll();

        // MAPS
        $listeLieux = [];
        foreach ($lieux as $lieu) {
            $name = $lieu->getNom();
            $cooX = $lieu->getCooX();
            $cooY = $lieu->getCooY();
            
            $annonceListe = [];
            foreach ($lieu->getAnnonce() as $annonce) {
                $libelle = $annonce->getLibelleProduit();
                $id = $annonce->getId();

                $annonceListe[] = array(
                    'libelle' => $libelle,
                    'id' => $id,
                );
            }
            
            $listeLieux[] = array(
                'name' => $name,
                'cooX'=> $cooX,
                'cooY' => $cooY,
                'annonce' => $annonceListe,
            );
                
        }


        if ($user != NULL) {
            $producteur = $producteurRepository->find($this->getUser());
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
                $categorie = $annonce->getCategorie();
                    
                    $listeDesAnnonces[] = array(
                        'id' => $id,
                        'libelle' => $libelle,
                        'cDebut' => $creneauxDebut,
                        'cFin' => $creneauxFin,
                        'status' => $status,
                        'date' => $dateMiseEnLigne,
                        'quantite' => $quantite,
                        'prix' => $prixUnitaire,
                        'categorie' => $categorie
                    );
            }
        }

        if($user == null){
            return $this->render('main/index.html.twig', [
                'listeLieux' => $listeLieux,
            ]);
        }else{
            return $this->render('panel_prod/index.html.twig', [
                'listeLieux' => $listeLieux,
                'tableauAnnonce' => $listeDesAnnonces,

            ]);
        }
    }

    #[Route('/ajout/{id}', name: 'panierAjout')]
    public function ajoutPanier(AnnonceRepository $annonceRepository, String $id): Response
    {
        $annonce = $annonceRepository->findById($id);
        $session = new Session();
        $session->start();

        $panier = [];
        if ($session->get('panier') != NULL) {
            foreach ($session->get('panier') as $p) {
                array_push($panier, $p);
            }
        }
        array_push($panier, $annonce[0]);
        
        $session->set('panier', $panier);
        
        $this->addFlash(
            'alert',
            "Item ajouter"
        );
        
        return $this->redirectToRoute('main_page');
    }

    #[Route('/panier', name: 'panier_show')]
    public function showPanier(AnnonceRepository $annonceRepository): Response
    {
        $session = new Session();
        $session->start();

        $listePanier = [];
        foreach ($session->get('panier') as $detailPanier) {
            $annonce = $annonceRepository->findById($detailPanier->getId($detailPanier->getId()));
            $lieuAnnonce = $annonce->getLieux();
        }

       return $this->render('main/panier.html.twig', [
           'panier' => $session->get('panier'),
       ]);
    }

    #[Route('/panier/clear', name: 'clearPanier')]
    public function clearPanier(): Response
    {
        $session = new Session();
        $session->start();

        $session->clear();

       return $this->redirectToRoute('main_page');
    }
}
