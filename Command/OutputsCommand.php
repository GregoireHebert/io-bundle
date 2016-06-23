<?php

namespace Gheb\IOBundle\Command;

use Gheb\IOBundle\Outputs\AbstractOutput;
use Gheb\IOBundle\Outputs\OutputsAggregator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
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
     * @var OutputsAggregator
     */
    private $outputsAggregator;

    /**
     * OutputsCommand constructor.
     *
     * @param OutputsAggregator $aggregator
     */
    public function __construct(OutputsAggregator $aggregator)
    {
        $this->outputsAggregator = $aggregator;
        parent::__construct();
    }

    /**
     * configure the command
     */
    protected function configure()
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
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $aggregated = $this->outputsAggregator->getAggregated($name);
        if ($aggregated instanceof AbstractOutput) {
            try {
                return $aggregated->apply();
            } catch (\Exception $e) {
                $output->writeln($e->getMessage());
            }
        } else {
            $output->writeln('This output does not exists');
        }
    }
}
