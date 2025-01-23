<?php

namespace App\Security;

use App\Entity\Conge;
use App\Entity\User;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CongeVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        return $subject instanceof Conge && in_array($attribute, ['CONGE_EDIT', 'CONGE_VIEW']);
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        // Logique basée sur les rôles ou la propriété de l'entité
        switch ($attribute) {
            case 'CONGE_EDIT':
            return $user->getRoles() === 'ROLE_RH' || $subject->getUser() === $user;
            case 'CONGE_VIEW':
            return $subject->getUser() === $user;
        }

        return false;
    }
}