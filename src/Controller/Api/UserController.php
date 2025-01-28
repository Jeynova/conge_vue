<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/user')]
class UserController extends AbstractController
{
    #[Route('/dashboard', name: 'api_user_dashboard', methods: ['GET'])]
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

    #[Route('/all', name: 'api_user_all', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function allUsers(UserRepository $userRepository): JsonResponse
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
