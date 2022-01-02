<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Lieu;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use App\Repository\CategorieRepository;
use App\Entity\Categorie;
use App\Repository\LieuRepository;
use App\Repository\ProducteurRepository;
use DateTimeImmutable;
use Producteur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panel/annonce')]
class AnnonceController extends AbstractController
{
    #[Route('/', name: 'annonce_index', methods: ['GET'])]
    public function index(AnnonceRepository $annonceRepository): Response
    {
        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
            
        ]);
    }

    #[Route('/new', name: 'annonce_new', methods: ['GET','POST'])]
    public function new(Request $request, CategorieRepository $categorieRepository, ProducteurRepository $producteurRepository, AnnonceRepository $annonceRepository, LieuRepository $lieuRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $annonce = new Annonce();

        $lieux = $producteurRepository->find($this->getUser());
        $listelieux = [];

        foreach ($lieux->getLieux() as $lieu) {
            $nom = $lieu->getNom();
            $id = $lieu->getId();
                
                $listelieux[] = array(
                    'nom' => $nom,
                    'id' => $id,
                );
        }
        
            
        if ($request->request->get('inscription') != NULL ) {
            $creneauxDebut = new DateTimeImmutable($request->request->get('creneauxDebut'));
            $creneauxFin = new DateTimeImmutable($request->request->get('creneauxFin'));

            $categorie = $categorieRepository->find($request->request->get('categorie'));
            $lieu = $lieuRepository->find($request->request->get('leslieux'));
            $producteur = $producteurRepository->find($this->getUser());

            $annonce->setCreneauxDebut($creneauxDebut);
            $annonce->setCreneauxFin($creneauxFin);
            $annonce->setLibelleProduit($request->request->get('libelleProduit'));
            $annonce->setPrixUnitaire($request->request->get('prixUnitaire'));
            $annonce->setQuantite($request->request->get('quantite'));
            $annonce->setCategorie($categorie);
            $annonce->setLieu($lieu);
            $annonce->setStatus('PasEnLigne');

            $producteur->addAnnonce($annonce);
            

            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('main_page');
        }

        return $this->render('annonce/new.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'lieux' => $listelieux,
        ]);
    }

    #[Route('/{id}', name: 'annonce_show', methods: ['GET'])]
    public function show(Annonce $annonce): Response
    {
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    #[Route('/{id}/edit', name: 'annonce_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Annonce $annonce , CategorieRepository $categorieRepository , LieuRepository $lieuRepository , ProducteurRepository $producteurRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categories = $categorieRepository->findById($request->request->get('categorie'));
        
        
        
        $lieux = $producteurRepository->find($this->getUser());
        $listelieux = [];

        foreach ($lieux->getLieux() as $lieu) {
            $nom = $lieu->getNom();
            $id = $lieu->getId();
                
                $listelieux[] = array(
                    'nom' => $nom,
                    'id' => $id,
                );
        }

        //Edition libellé du produit
        if ($request->request->get('libelleProd') != null) {
            $annonce->setLibelleProduit($request->request->get('libelleProd'));
        }

        //Edition Prix unitaire
        if ($request->request->get('prixUnitaire') != null) {
            $annonce->setPrixUnitaire($request->request->get('prixUnitaire'));
        }

        //Edition quantité
        if ($request->request->get('quantite') != null) {
            $annonce->setQuantite($request->request->get('quantite'));
        }

        //Edition lieu
        if ($request->request->get('lesLieux') != null) {
            $annonce->setLieu($request->request->get('lesLieux'));
        }

        //Edition Créneaux Début
        if ($request->request->get('cDebut') != null) {
            $annonce->setCreneauxDebut($creneauxDebut = new DateTimeImmutable($request->request->get('cDebut')));
        }

        //Edition Créneaux Fin
        if ($request->request->get('cFin') != null) {
            $annonce->setCreneauxDebut($creneauxFin = new DateTimeImmutable($request->request->get('cFin')));
        }

        //Edition Catégorie
        if ($request->request->get('categorie') != null) {
            $annonce->setCategorie($request->request->get('categorie'));
        }

        $entityManager->persist($annonce);
        $entityManager->flush();

        return $this->renderForm('annonce/edit.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'lieux' => $listelieux,
            'annonce' => $annonce,
        ]);

    }

    #[Route('/{id}', name: 'annonce_delete', methods: ['POST'])]
    public function delete(Request $request, Annonce $annonce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonce_index', [], Response::HTTP_SEE_OTHER);
    }
}
