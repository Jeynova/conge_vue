<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/admin/login', name: 'admin_login')]
    public function adminLogin(): Response
    {
        return $this->render('security/admin_login.html.twig');
    }

    #[Route('/login', name: 'user_login')]
    public function userLogin(): Response
    {
        return $this->render('security/user_login.html.twig');
    }
    
    #[Route('/logout', name: 'logout')]
    public function logout(): void
    {
        // Symfony gère automatiquement cette route
    }
}
