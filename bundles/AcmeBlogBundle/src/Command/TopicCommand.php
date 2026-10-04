<?php

declare(strict_types=1);

namespace Acme\BlogBundle\Command;

use Acme\BlogBundle\TopicManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Exercise 3: an invokable command (Symfony 7.3+): no need to extend Command.
 */
#[AsCommand(name: 'acme:blog:topics', description: 'Lists the blog topics')]
final class TopicCommand
{
    public function __construct(private readonly TopicManager $topicManager) {}

    public function __invoke(SymfonyStyle $io): int
    {
        $titles = array_column($this->topicManager->all(), 'title');

        if ([] === $titles) {
            $io->info('There are no topics yet.');

            return Command::SUCCESS;
        }

        $io->listing($titles);

        return Command::SUCCESS;
    }
}
