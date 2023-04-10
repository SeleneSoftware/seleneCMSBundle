<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'user:delete',
    description: 'Add a short description for your command',
)]
class UserDeleteCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL, 'Email address to elevate to Admin privileges')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');

        if ($email) {
            $repo = $entityManager->getRepository(User::class);
        } else {
            $email = $io->ask('Email Address of user to delete:', null, function ($email) {
                if (!$email) {
                    throw new \RuntimeException('You must use an email address.');
                }

                return $email;
            });
        }

        $user = $repo->findOneBy(['email'=>$email]);
        if (!$user) {
            throw new \RuntimeException('User not found');
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush($user);

        $io->success(sprintf('User %s has admin privileges.', $user->getEmail()));

        return Command::SUCCESS;
    }
}
