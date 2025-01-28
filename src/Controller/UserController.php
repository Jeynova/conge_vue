<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route(name: 'app_user_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('base.html.twig'); // Charge l'index Vue.js
    }

    #[Route('/profile', name: 'app_user_profile', methods: ['GET'])]
    public function profile(): Response
    {
        return $this->render('base.html.twig'); // Charge aussi l'index Vue.js
    }
}
