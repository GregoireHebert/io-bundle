<?php

namespace Gheb\IOBundle\Command;

use Gheb\IOBundle\Outputs\AbstractOutput;
use Gheb\IOBundle\Aggregator\Aggregator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'gheb:io:output', description: 'Applies an Output')]
class OutputsCommand extends Command
{
    private Aggregator $outputsAggregator;

    public function __construct(Aggregator $aggregator)
    {
        parent::__construct();
        $this->outputsAggregator = $aggregator;
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Which Output to trigger'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $aggregated = $this->outputsAggregator->getAggregated($name);

        if (!$aggregated instanceof AbstractOutput) {
            $output->writeln('This output does not exists');
        }

        try {
            $aggregated->apply();
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
    }
}
