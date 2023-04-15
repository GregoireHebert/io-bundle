<?php

namespace Gheb\IOBundle\Outputs;

use Gheb\IOBundle\IOInterface;

abstract class AbstractOutput implements IOInterface
{
    /**
     * Apply method
     */
    abstract public function apply();

    /**
     * Return the OutputName for command retrieval
     *
     * @return string
     */
    abstract public function getName(): string;
}
