<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/admin')]
class AdminController extends AbstractController
{
    #[Route('/users', name: 'api_admin_users', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function listUsers(UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findAll();

        $data = array_map(fn($user) => [
            'id' => $user->getId(),
            'prenom' => $user->getPrenom(),
            'nom' => $user->getNom(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'soldeConge' => $user->getSoldeConge(),
        ], $users);

        return $this->json($data);
    }
}
