<?php

namespace Gheb\IOBundle\Outputs;

use Doctrine\ORM\EntityManager;
use Gheb\IOBundle\IOInterface;

/**
 * Class AbstractOutput
 * @author  Grégoire Hébert <gregoire@opo.fr>
 * @package Gheb\IOBundle\Outputs
 */
abstract class AbstractOutput implements IOInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * AbstractOutput constructor.
     *
     * @param EntityManager $em
     *
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

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
