<?php

namespace Gheb\IOBundle\Aggregator;

use Doctrine\Common\Collections\ArrayCollection;
use Gheb\IOBundle\Inputs\AbstractInput;
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
     * @throws \Exception
     */
    public function addIO($io)
    {
        if (!$io instanceof AbstractInput && !$io instanceof AbstractOutput) {
            throw new \Exception('io must be an instance of '.AbstractInput::class.' or '.AbstractOutput::class.' but '.get_class($io).' instead !');
        }

        $this->aggregate->add($io);
    }

    /**
     * Return the number of io aggregated
     * @return int
     */
    public function count()
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
            function ($aggregated) use ($name) {
                /** @var AbstractOutput|AbstractInput $aggregated */
                return strtolower($aggregated->getName()) == strtolower($name);
            }
        );

        return $aggregated->first();
    }
}