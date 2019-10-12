<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FullInitializationCommand extends Command
{
    protected function configure()
    {
        $this->setName('dicehoarders:initialization')
            ->setDescription('Initializes a full Dicehoarders Project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}