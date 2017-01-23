<?php

namespace Isometriks\Bundle\JsonLdDumperBundle;

class Registry implements RegistryInterface
{
    private $things;

    public function __construct($things = array())
    {
        $this->things = $things;
    }

    public function register($thing)
    {
        $this->things[] = $thing;
    }

    public function all()
    {
        return $this->things;
    }
}
