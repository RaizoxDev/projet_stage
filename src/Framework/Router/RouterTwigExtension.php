<?php

namespace App\Framework\Router;

use App\Framework\Router;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class RouterTwigExtension extends AbstractExtension
{
    public function __construct(
        private Router $router
    ){}

    public function getFunctions()
    {
        return [
            new TwigFunction('path', [$this, 'pathFor'])
        ];
    }

    public function pathFor(string $path, array $params = []): string
    {
        return $this->router->generateUri($path, $params);
    }
}