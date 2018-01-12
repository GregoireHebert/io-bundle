<?php

namespace Gheb\IOBundle\Inputs;

use Doctrine\ORM\EntityManager;
use Gheb\IOBundle\IOInterface;

/**
 * Class AbstractInput
 * @author  Grégoire Hébert <gregoire@opo.fr>
 * @package Gheb\IOBundle\Inputs
 */
abstract class AbstractInput implements IOInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * AbstractInput constructor.
     *
     * @param EntityManager $em
     *
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

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
