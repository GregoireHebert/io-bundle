<?php

namespace Gheb\IOBundle\Outputs;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class AbstractOutput
 * @author  Grégoire Hébert <gregoire@opo.fr>
 * @package Gheb\IOBundle\Outputs
 */
abstract class AbstractOutput
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
     * @throws EntityNotFoundException
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Apply method
     */
    public abstract function apply();

    /**
     * Return the OutputName for command retrieval
     * @return string
     */
    public abstract function getName();
}
