<?php

namespace Isometriks\Bundle\JsonLdDumperBundle\Twig;

use Isometriks\Bundle\JsonLdDumperBundle\RegistryInterface;
use Isometriks\JsonLdDumper\DumperInterface;

class JsonLdDumperExtension extends \Twig_Extension
{
    private $dumper;
    private $registry;

    public function __construct(DumperInterface $dumper, RegistryInterface $registry)
    {
        $this->dumper = $dumper;
        $this->registry = $registry;
    }

    public function dump($name, $context = null)
    {
        return $this->dumper->dump($name, $context);
    }

    public function dumpAll()
    {
        return $this->dump($this->registry->all());
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('json_ld_dump', array($this, 'dump'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('json_ld_dump_all', array($this, 'dumpAll'), array('is_safe' => array('html'))),
        );
    }

    public function getName()
    {
        return 'isometriks_json_ld_dumper';
    }
}
