<?php

namespace Isometriks\Bundle\JsonLdDumperBundle;

interface RegistryInterface
{
    /**
     * Register a static resource or object
     *
     * @param mixed $thing
     */
    public function register($thing);

    /**
     * Return all registered things
     *
     * @return array
     */
    public function all();
}
