<?php

namespace Lia\Bridge\DhtmlxBundle\DependencyInjection;

use Lia\KernelBundle\DependencyInjection\ConfigurationBase;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration
    extends ConfigurationBase
{
    private $defaultTheme   =  'skyblue';
    private $availableTheme = ['skyblue', 'terrace', 'web'];

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lia_bridge_dhtmlx');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->scalarNode('theme')
                    ->defaultValue($this->defaultTheme)
                    ->validate()
                    ->ifNotInArray($this->availableTheme)
                        ->thenInvalid('Theme "%s" is not present. Available ['
                            .implode(' | ', $this->availableTheme)
                            .']'
                        )
                    ->end()
                ->end()
                ->arrayNode('plugins')
                    ->children()
                        ->scalarNode('accordion')->end()
                        ->scalarNode('calendar')->end()
                        ->scalarNode('chart')->end()
                        ->scalarNode('colorPicker')->end()
                        ->scalarNode('dataView')->end()
                        ->scalarNode('editor')->end()
                        ->scalarNode('form')->end()
                        ->scalarNode('grid')->end()
                        ->scalarNode('layout')->end()
                        ->scalarNode('menu')->end()
                        ->scalarNode('message')->end()
                        ->scalarNode('popup')->end()
                        ->scalarNode('ribbon')->end()
                        ->scalarNode('slider')->end()
                        ->scalarNode('tabbar')->end()
                        ->scalarNode('toolbar')->end()
                        ->scalarNode('treeGrid')->end()
                        ->scalarNode('windows')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
