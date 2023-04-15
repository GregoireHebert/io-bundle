<?php

namespace Gheb\IOBundle\Inputs;

use Gheb\IOBundle\IOInterface;

abstract class AbstractInput implements IOInterface
{
    /**
     * Return the InputName for command retrieval
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Getting the value of the input
     * @return mixed
     */
    abstract public function getValue();
}
