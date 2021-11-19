<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Lieu;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use App\Repository\CategorieRepository;
use App\Entity\Categorie;
use App\Repository\ProducteurRepository;
use DateTimeImmutable;
use Producteur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/annonce')]
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
    public function new(Request $request, CategorieRepository $categorieRepository, ProducteurRepository $producteurRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $annonce = new Annonce();
        $lieu = new Lieu();
        
        
        if ($request->request->get('inscription') != NULL ) {
            $creneauxDebut = new DateTimeImmutable($request->request->get('creneauxDebut'));
            $creneauxFin = new DateTimeImmutable($request->request->get('creneauxFin'));

            $categorie = $categorieRepository->find($request->request->get('categorie'));
            $producteur = $producteurRepository->find($this->getUser());
            dump($request->request->get('categorie'));
            dump($this->getUser());
            dump($categorie);
            dump($producteur);

            $coordonne = explode(',', $request->request->get('lieu'));
            $lieu->setCooX($coordonne[0]);
            $lieu->setCooY($coordonne[1]);
            $lieu->setNom($request->request->get('lieuNom'));
            $lieu->setDescLieu($request->request->get('lieuDescription'));


            $annonce->setCreneauxDebut($creneauxDebut);
            $annonce->setCreneauxFin($creneauxFin);
            $annonce->setLibelleProduit($request->request->get('libelleProduit'));
            $annonce->setPrixUnitaire($request->request->get('prixUnitaire'));
            $annonce->setQuantite($request->request->get('quantite'));
            $annonce->setCategorie($categorie);
            $annonce->setStatus('PasEnLigne');

            $lieu->addAnnonce($annonce);
            $producteur->addAnnonce($annonce);

            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce/new.html.twig', [
            'categories' => $categorieRepository->findAll(),
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
    public function edit(Request $request, Annonce $annonce): Response
    {
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
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
