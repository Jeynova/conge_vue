<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:add-user',
    description: 'Ajoute un nouvel utilisateur dans la base de données',
)]
class AddUserCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        // Demande les informations utilisateur
        $email = $helper->ask($input, $output, new Question('Email de l\'utilisateur : '));
        $password = $helper->ask($input, $output, new Question('Mot de passe de l\'utilisateur : '));
        $roles = explode(',', $helper->ask($input, $output, new Question('Rôles (séparés par des virgules, ex: ROLE_USER,ROLE_ADMIN) [ROLE_USER] : ', 'ROLE_USER')));
        $nom = $helper->ask($input, $output, new Question('Nom de l\'utilisateur : '));
        $prenom = $helper->ask($input, $output, new Question('Prénom de l\'utilisateur : '));
        $soldeConge = (float) $helper->ask($input, $output, new Question('Solde des congés [25] : ', '25'));

        // Création de l'utilisateur
        $user = new User();
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setSoldeConge($soldeConge);

        // Hachage du mot de passe
        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);

        // Sauvegarde en base de données
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('<info>Utilisateur ajouté avec succès !</info>');

        return Command::SUCCESS;
    }
}
