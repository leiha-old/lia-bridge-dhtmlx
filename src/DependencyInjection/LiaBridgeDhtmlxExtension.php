<?php

namespace Lia\Bridge\DhtmlxBundle\DependencyInjection;

use Lia\KernelBundle\DependencyInjection\ExtensionBase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LiaBridgeDhtmlxExtension
    extends ExtensionBase
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $resourceDefinition = $container->getDefinition('lia.subscriber.theme.dhtmlx');
        $resourceDefinition->addMethodCall('setConfiguration', array($config));


    }
}
