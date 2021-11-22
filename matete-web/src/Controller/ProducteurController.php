<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Producteur;
use App\Form\ProducteurType;
use App\Repository\AnnonceRepository;
use App\Repository\LieuRepository;
use App\Repository\ProducteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[Route('/producteur')]
class ProducteurController extends AbstractController
{
    #[Route('/', name: 'producteur_index', methods: ['GET'])]
    public function index(ProducteurRepository $producteurRepository): Response
    {
        return $this->render('producteur/index.html.twig', [
            'producteurs' => $producteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'producteur_new', methods: ['GET','POST'])]
    public function new(Request $request, LieuRepository $lieuRepository, AnnonceRepository $annonceRepository, UserPasswordEncoderInterface $userPass): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $producteur = new Producteur();

        $passHash = ($userPass->encodePassword($producteur, $request->request->get('pass')));

        $producteur->setNom($request->request->get('nom'));
        $producteur->setPrenom($request->request->get('prenom'));
        $producteur->setTel($request->request->get('tel'));
        $producteur->setMail($request->request->get('mail'));
        $producteur->setMdp($passHash);

        $entityManager->persist($producteur);
        $entityManager->flush();
        
        return $this->redirectToRoute("panel_prod");
    }

    #[Route('/{id}', name: 'producteur_show', methods: ['GET'])]
    public function show(Producteur $producteur): Response
    {
        return $this->render('producteur/show.html.twig', [
            'producteur' => $producteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'producteur_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Producteur $producteur): Response
    {
        
        //Edition Nom
        if ($request->request->get('nom') != null) {
            $user->setNom($request->request->get('nom'));
        }

        //Edition Prenom
        if ($request->request->get('prenom') != null) {
            $user->setPrenom($request->request->get('prenom'));
        }

    //Edition Telephone
        if ($request->request->get('tel') != null) {
            $user->setTel($request->request->get('tel'));
        }

        //Edition Email
        if ($request->request->get('mail') != null) {
            $user->setMail($request->request->get('mail'));
        }

        

    

        return $this->render('producteur/edit.html.twig', [
            'producteur' => $producteur
        ]);
    }

    #[Route('/{id}', name: 'producteur_delete', methods: ['POST'])]
    public function delete(Request $request, Producteur $producteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$producteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($producteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('producteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
