<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class DashboardController extends AbstractController
{
    #[Route(name: 'admin_dashboard', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('base.html.twig'); // Vue.js s'occupera de l'administration
    }
}
