<?php

namespace Gheb\IOBundle\Command;

use Gheb\IOBundle\Outputs\AbstractOutput;
use Gheb\IOBundle\Aggregator\Aggregator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class OutputsCommand
 * @author  Grégoire Hébert <gregoire@opo.fr>
 * @package Gheb\IOBundle\Command
 */
class OutputsCommand extends ContainerAwareCommand
{
    /**
     * @var Aggregator
     */
    private $outputsAggregator;

    /**
     * OutputsCommand constructor.
     *
     * @throws LogicException
     *
     * @param Aggregator $aggregator
     */
    public function __construct(Aggregator $aggregator)
    {
        $this->outputsAggregator = $aggregator;
        parent::__construct();
    }

    /**
     * configure the command
     *
     * @throws InvalidArgumentException
     */
    protected function configure(): void
    {
        $this
            ->setName('gheb:io:output')
            ->setDescription('Applies an Output')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Which Output to trigger'
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws InvalidArgumentException
     *
     * @return bool
     */
    protected function execute(InputInterface $input, OutputInterface $output): bool
    {
        $name = $input->getArgument('name');
        $aggregated = $this->outputsAggregator->getAggregated($name);
        if ($aggregated instanceof AbstractOutput) {
            try {
                return $aggregated->apply();
            } catch (\Exception $e) {
                $output->writeln($e->getMessage());
                return false;
            }
        } else {
            $output->writeln('This output does not exists');
        }

        return true;
    }
}
