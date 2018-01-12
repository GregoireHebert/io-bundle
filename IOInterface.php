<?php

namespace Gheb\IOBundle;


interface IOInterface
{
    /**
     * Return the OutputName for command retrieval
     * @return string
     */
    public function getName(): string;
}
