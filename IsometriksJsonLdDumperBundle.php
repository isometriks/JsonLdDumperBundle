<?php

namespace Isometriks\Bundle\JsonLdDumperBundle;

use Isometriks\Bundle\JsonLdDumperBundle\DependencyInjection\Compiler\ReplacerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class IsometriksJsonLdDumperBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ReplacerCompilerPass());
    }
}
