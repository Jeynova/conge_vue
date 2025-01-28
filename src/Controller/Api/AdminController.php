<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/user', name: 'api_user_')]
class AdminController extends AbstractController
{
    #[Route('/api/admin/users', name: 'api_admin_users', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function getUsers(UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findAll();
        $data = array_map(fn($user) => [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
        ], $users);

        return $this->json($data);
    }
}
