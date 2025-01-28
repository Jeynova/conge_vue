<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{
    #[Route('/{reactRouting}', name: 'app_frontend', requirements: ['reactRouting' => '^(?!api|admin).*'], priority: -1)]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
