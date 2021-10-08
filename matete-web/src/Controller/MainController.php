<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(AnnonceRepository $annonceRepository, LieuRepository $lieuRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
            'lieux' => $lieuRepository->findAll(),

        ]);
    }
}
