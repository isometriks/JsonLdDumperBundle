<?php

namespace Isometriks\Bundle\JsonLdDumperBundle\Replacer;

use Isometriks\JsonLdDumper\Replacer\ReplacerInterface;
use Isometriks\JsonLdDumper\Replacer\ReturnValue;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ExpressionReplacer implements ReplacerInterface
{
    private $container;
    private $expressionLanguage;

    public function __construct(ContainerInterface $container, ExpressionLanguage $expressionLanguage)
    {
        $this->container = $container;
        $this->expressionLanguage = $expressionLanguage;
    }

    public function canParse($value, $context = null)
    {
        if (!is_string($value)) {
            return false;
        }

        return substr($value, 0, 5) === 'expr:';
    }

    public function replace($value, $context = null)
    {
        $expression = substr($value, 5);
        $result = $this->expressionLanguage->evaluate($expression, array(
            'context' => $context,
            'container' => $this->container,
        ));

        return new ReturnValue($result, false);
    }
}