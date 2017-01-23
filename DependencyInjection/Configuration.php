<?php

namespace Isometriks\Bundle\JsonLdDumperBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('isometriks_json_ld_dumper');

        $rootNode
            ->children()
                ->arrayNode('static')
                    ->prototype('array')
                        ->children()
                            ->booleanNode('always_include')->defaultFalse()->end()
                            ->variableNode('mapping')->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('entity')
                    ->prototype('array')
                        ->children()
                            ->variableNode('mapping')->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
