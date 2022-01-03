<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Lieu;
use App\Repository\AnnonceRepository;
use App\Repository\CategorieRepository;
use App\Repository\LieuRepository;
use App\Repository\ProducteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie as HttpFoundationCookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_page')]
    public function index(Request $request, AnnonceRepository $annonceRepository, LieuRepository $lieuRepository, ProducteurRepository $producteurRepository, CategorieRepository $categorieRepository): Response
    {
        $session = new Session();
        $session->start();

        $response = new Response();
        $cookie = new HttpFoundationCookie('visite', 'true' ,time() + (365 * 24 * 60 * 60));
        $response->headers->setCookie($cookie);
        $response->sendHeaders();
        $cookie = $request->cookies->get('visite');

        dump($session->get('panier'));

        $user = $this->getUser();
        $lieux = $lieuRepository->findAll();
        $categories = $categorieRepository->findAll();

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
        // Liste catégorie
        $ListeCategorie=[];
        foreach($categories as $uneCategorie){
            $id = $uneCategorie->getId();
            $libelle = $uneCategorie->getLibelle();
            $listeCategorie[] = array(
                'id' => $id,
                'libelle'=> $libelle,
            );
        }


        if($user == null){
            return $this->render('main/index.html.twig', [
                'listeLieux' => $listeLieux,
                'cookies' => $cookie,
                'ListeCategorie' => $listeCategorie,
            ]);
        }else{
            return $this->render('panel_prod/index.html.twig', [
                'listeLieux' => $listeLieux,
                'cookies' => $cookie,
                'tableauAnnonce' => $listeDesAnnonces,
                'ListeCategorie' => $listeCategorie,
            ]);
        }
    }

    #[Route('/filtre', name: 'filtre')]
    public function filtre(): Response
    {

        $session = new Session();
        $session->start();
        return $this->render('main/filtre.html.twig', [
        ]);
    }

    #[Route('/ajout/{id}', name: 'panierAjout')]
    public function ajoutPanier(AnnonceRepository $annonceRepository, Annonce $annonce, LieuRepository $lieuRepository): Response
    {
        $annon = $annonce;
        $idLieu = $annon->getLieu()->getId();
        $lieu = $lieuRepository->findById($idLieu);
        $session = new Session();
        $session->start();

        $panier = [];
        if ($session->get('panier') != NULL) {
            foreach ($session->get('panier') as $p) {
                array_push($panier, $p);
            }
        }
        array_push($panier, [
            'annonce' => $annon,
            'lieu' => $lieu[0],
        ]);
        
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
