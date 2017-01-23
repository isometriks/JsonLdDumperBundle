<?php

namespace Isometriks\Bundle\JsonLdDumperBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ReplacerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $tags = $container->findTaggedServiceIds('isometriks_json_ld_dumper.replacer');
        $replacers = [];

        foreach ($tags as $id => $tags) {
            $replacers[] = new Reference($id);
        }

        $parserDefinition = $container->getDefinition('isometriks_json_ld_dumper.parser');
        $parserDefinition->replaceArgument(1, $replacers);
    }
}
