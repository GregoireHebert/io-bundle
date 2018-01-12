<?php

namespace Gheb\IOBundle\Aggregator;

use Doctrine\Common\Collections\ArrayCollection;
use Gheb\IOBundle\Inputs\AbstractInput;
use Gheb\IOBundle\IOInterface;
use Gheb\IOBundle\Outputs\AbstractOutput;

/**
 * Class Aggregator
 * @author  Grégoire Hébert <gregoire@opo.fr>
 * @package Gheb\IOBundle
 */
class Aggregator
{
    /**
     * @var ArrayCollection
     */
    public $aggregate;

    /**
     * Aggregator constructor.
     */
    public function __construct()
    {
        $this->aggregate = new ArrayCollection();
    }

    /**
     * Aggregate all input/output in one place
     *
     * @param AbstractInput|AbstractOutput $io
     * @throws \InvalidArgumentException
     */
    public function addIO($io): void
    {
        if (!$io instanceof AbstractInput && !$io instanceof AbstractOutput) {
            throw new \InvalidArgumentException('io must be an instance of '.AbstractInput::class.' or '.AbstractOutput::class.' but '.\get_class($io).' instead !');
        }

        $this->aggregate->add($io);
    }

    /**
     * Return the number of io aggregated
     * @return int
     */
    public function count(): int
    {
        return $this->aggregate->count();
    }

    /**
     * Return a aggregated input/output according to it's name
     *
     * @param $name
     *
     * @return AbstractOutput|AbstractInput
     */
    public function getAggregated($name)
    {
        $aggregated = $this->aggregate->filter(
            function (IOInterface $aggregated) use ($name) {
                /** @var AbstractOutput|AbstractInput $aggregated */
                return strtolower($aggregated->getName()) === strtolower($name);
            }
        );

        return $aggregated->first();
    }
}
