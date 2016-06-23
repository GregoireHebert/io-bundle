<?php
namespace Gheb\IOBundle;

use Gheb\IOBundle\DependencyInjection\Compiler\AggregatorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class IOBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AggregatorCompilerPass());
    }
}
