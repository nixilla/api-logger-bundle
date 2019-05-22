<?php

namespace Nixilla\Api\LoggerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('nixilla_api_logger');

        if ( ! method_exists($treeBuilder, 'getRootNode')) {
            $treeBuilder->root('nixilla_api_logger');
        }

        return $treeBuilder;
    }
}
