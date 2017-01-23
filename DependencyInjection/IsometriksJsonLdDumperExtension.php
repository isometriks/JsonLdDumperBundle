<?php

namespace Isometriks\Bundle\JsonLdDumperBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class IsometriksJsonLdDumperExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $staticMappings = $this->getMappings($config['static']);
        $entityMappings = $this->getMappings($config['entity']);

        // Set parameters
        $container->setParameter('isometriks_json_ld_dumper.mappings.static', $staticMappings);
        $container->setParameter('isometriks_json_ld_dumper.mappings.entity', $entityMappings);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        // Add the always include mappings to the registry
        $alwaysInclude = [];

        foreach ($config['static'] as $key => $value) {
            if ($value['always_include']) {
                $alwaysInclude[] = sprintf('$static.%s', $key);
            }
        }

        $registryDefinition = $container->getDefinition('isometriks_json_ld_dumper.registry');
        $registryDefinition->replaceArgument(0, $alwaysInclude);
    }

    private function getMappings(array $data)
    {
        $mappings = [];

        foreach ($data as $key => $values) {
            $mappings[$key] = $values['mapping'];
        }

        return $mappings;
    }
}
