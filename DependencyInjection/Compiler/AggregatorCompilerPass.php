<?php

namespace Gheb\IOBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AggregatorCompilerPass
 * @author  Grégoire Hébert <gregoire@opo.fr>
 * @package Gheb\IOBundle\DependencyInjection\Compiler
 */
class AggregatorCompilerPass implements CompilerPassInterface
{
    /**
     * Add rules validators to the RulesValidator
     * @param ContainerBuilder $container
     *
     * @throws ServiceNotFoundException
     * @throws InvalidArgumentException
     */
    public function process(ContainerBuilder $container): void
    {
        $inputAggregator  = $container->getDefinition('gheb.io.aggregator.inputs');
        $outputAggregator = $container->getDefinition('gheb.io.aggregator.outputs');

        $inputs  = array_keys($container->findTaggedServiceIds('gheb.io.input'));
        $outputs = array_keys($container->findTaggedServiceIds('gheb.io.output'));

        foreach ($inputs as $inputId) {
            $input = new Reference($inputId);
            $inputAggregator->addMethodCall('addIO', array($input));
        }

        foreach ($outputs as $outputId) {
            $output = new Reference($outputId);
            $outputAggregator->addMethodCall('addIO', array($output));
        }
    }
}
