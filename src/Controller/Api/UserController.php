<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/user', name: 'api_user_')]
class UserController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function dashboard(): JsonResponse
    {
        $user = $this->getUser();
        if (!$user instanceof \App\Entity\User) {
            throw new \LogicException('The logged-in user is not a valid instance of User.');
        }
        return $this->json([
            'userName' => $user->getPrenom() . ' ' . $user->getNom(),
            'soldeConge' => $user->getSoldeConge(),
        ]);
    }

    
}

