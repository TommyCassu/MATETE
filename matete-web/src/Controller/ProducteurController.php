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
    public function edit(Request $request, Producteur $producteur, UserPasswordEncoderInterface $userPass): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        //Edition Nom
        if ($request->request->get('nom') != null) {
            $producteur->setNom($request->request->get('nom'));
        }

        //Edition Prenom
        if ($request->request->get('prenom') != null) {
            $producteur->setPrenom($request->request->get('prenom'));
        }

        //Edition Telephone
        if ($request->request->get('tel') != null) {
            $producteur->setTel($request->request->get('tel'));
        }

        //Edition Email
        if ($request->request->get('mail') != null) {
            $producteur->setMail($request->request->get('mail'));
        }

        //Verification mot de passe
        if ($request->request->get('passAnc') != null) {
            $oldPassword = $request->request->get('passAnc');
            $newPass = $request->request->get('pass');
            $newPassConf = $request->request->get('passConf');
            if ($userPass->isPasswordValid($producteur,$oldPassword)){
                if ($newPass != null){
                    if ($newPass == $newPassConf){
                        if ($newPass != $oldPassword ){
                            $passHash = ($userPass->encodePassword($producteur, $newPass)); 
                            $producteur->setMdp($passHash);
                        }else{
                            $this->addFlash(
                                'alert',
                                'Votre nouveau mot de passe ne peut pas être identique a votre mot de passe actuel'
                            );
                        }
                    }else{
                        $this->addFlash(
                            'alert',
                            'Veuillez entrez deux mot de passe identique'
                        );
                    }
                }else{
                    $this->addFlash(
                        'alert',
                        'Veuillez rentrer le nouveau mot de passe'
                    );
                }
            }
        }
        //$request->request->get('passAnc')
        
        $entityManager->persist($producteur);
        $entityManager->flush();

        return $this->redirectToRoute("main_page");
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
