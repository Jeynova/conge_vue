<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/admin/login', name: 'admin_login')]
    public function adminLogin(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // Récupère les erreurs de connexion, s'il y en a
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupère le dernier email saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/admin_login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/login', name: 'user_login')]
    public function userLogin(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // Récupère les erreurs de connexion, s'il y en a
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupère le dernier email saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/user_login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
    
    #[Route('/logout', name: 'logout')]
    public function logout(): void
    {
        // Symfony gère automatiquement cette route
    }
}
