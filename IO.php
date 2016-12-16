<?php

namespace Gheb\IOBundle;


interface IO
{
    /**
     * Return the OutputName for command retrieval
     * @return string
     */
    public function getName();
}