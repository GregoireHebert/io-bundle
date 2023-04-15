<?php

namespace Gheb\IOBundle\Command;

use Gheb\IOBundle\Inputs\AbstractInput;
use Gheb\IOBundle\Aggregator\Aggregator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\output\OutputInterface;

#[AsCommand(name: 'gheb:io:input', description: 'get an Input value')]
class InputsCommand extends Command
{
    private Aggregator $inputsAggregator;

    /**
     * InputsCommand constructor.
     *
     * @throws LogicException
     *
     * @param Aggregator $aggregator
     */
    public function __construct(Aggregator $aggregator)
    {
        parent::__construct();
        $this->inputsAggregator = $aggregator;
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Which Input to trigger'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $aggregated = $this->inputsAggregator->getAggregated($name);

        if (!$aggregated instanceof AbstractInput) {
            $output->writeln('This input does not exists');
        }

        try {
            $output->writeln($aggregated->getValue());
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
    }
}
