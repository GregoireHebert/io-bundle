<?php

namespace Gheb\IOBundle\Command;

use Gheb\IOBundle\Inputs\AbstractInput;
use Gheb\IOBundle\Aggregator\Aggregator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\output\OutputInterface;

/**
 * Class InputsCommand
 * @author  Grégoire Hébert <gregoire@opo.fr>
 * @package Gheb\IOBundle\Command
 */
class InputsCommand extends ContainerAwareCommand
{
    /**
     * @var Aggregator
     */
    private $inputsAggregator;

    /**
     * InputsCommand constructor.
     *
     * @throws LogicException
     *
     * @param Aggregator $aggregator
     */
    public function __construct(Aggregator $aggregator)
    {
        $this->inputsAggregator = $aggregator;
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
            ->setName('gheb:io:input')
            ->setDescription('get an Input value')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Which Input to trigger'
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $aggregated = $this->inputsAggregator->getAggregated($name);
        if ($aggregated instanceof AbstractInput) {
            try {
                $output->writeln($aggregated->getValue());
            } catch (\Exception $e) {
                $output->writeln($e->getMessage());
            }
        } else {
            $output->writeln('This input does not exists');
        }
    }
}
