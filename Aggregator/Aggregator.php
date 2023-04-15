<?php

namespace Gheb\IOBundle\Aggregator;

use Gheb\IOBundle\Inputs\AbstractInput;
use Gheb\IOBundle\Outputs\AbstractOutput;

class Aggregator
{
    public function __construct(
        public iterable $aggregates = new \ArrayIterator()
    ) {}

    public function addIO(AbstractInput|AbstractOutput $io): void
    {
        $this->aggregates->offsetSet($io->getName(), $io);
    }

    public function count(): int
    {
        return $this->aggregates->count();
    }

    public function getAggregated(string $name) :  AbstractOutput|AbstractInput
    {
        return $this->aggregates[$name] ?? throw new \LogicException("the Output or Input named $name does not exists.");
    }
}
