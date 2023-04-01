<?php

namespace Selene\CMSBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Selene\CMSBundle\Entity\User;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'user:new',
    description: 'Create a New User',
)]
class UserNewCommand extends Command
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL, 'Email address of the new user')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'Include to give admin privileges')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');

        if ($email) {
            $io->note(sprintf('Creating user with email %s', $email));
        } else {
            $email = $io->ask('Email Address of new user:', null, function ($email) {
                if (!$email) {
                    throw new \RuntimeException('You must use an email address.');
                }

                return $email;
            });
        }

        $user = new User();
        $user->setEmail($email);

        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                $io->askHidden('Please enter password', function ($password) {
                    if (!$password) {
                        throw new \RuntimeException('You must enter a password');
                    }

                    return $password;
                })
            )
        );

        $adminString = '';
        if ($admin = $input->getOption('admin')) {
            $user->addRole('ROLE_ADMIN');
            $adminString = ' with admin privileges';
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success(sprintf('User %s created%s.', $user->getEmail(), $adminString));

        return Command::SUCCESS;
    }
}
