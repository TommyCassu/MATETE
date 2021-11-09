<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/register', name: 'register_security')]
    public function login() : Response
    {
        return $this->render('security/register.html.twig');
    }

    #[Route('/login', name: 'login_security')]
    public function register() : Response
    {
        return $this->render('security/login.html.twig');
    }

    #[Route('/logout', name: 'logout_security')]
    public function logout()
    {
        //
    }
}
