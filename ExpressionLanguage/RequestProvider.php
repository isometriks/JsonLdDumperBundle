<?php

namespace Isometriks\Bundle\JsonLdDumperBundle\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestProvider implements ExpressionFunctionProviderInterface
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getFunctions()
    {
        return [
            new ExpressionFunction(
                'absolute_url',

                function ($path) {
                    return sprintf('$this->absolute_url(%s)', $path);
                },

                function (array $variables, $path) {
                    $masterRequest = $this->requestStack->getMasterRequest();

                    return $masterRequest->getUriForPath($path);
                }
            ),
        ];
    }
}
