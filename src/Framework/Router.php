<?php

namespace App\Framework;

use Framework\Router\Route;
use Mezzio\Router\FastRouteRouter;
use Psr\Http\Message\ServerRequestInterface;
use Mezzio\Router\Route as MezzioRoute;

class Router
{
    private $router;

    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    public function get(string $path, $callable, string $name)
    {
        $this->router->addRoute(new MezzioRoute($path, $callable, ['GET'], $name));
    }

    public function post(string $path, $callable, ?string $name = null)
    {
        $this->router->addRoute(new MezzioRoute($path, $callable, ['POST'], $name));
    }

    public function delete(string $path, $callable, ?string $name = null)
    {
        $this->router->addRoute(new MezzioRoute($path, $callable, ['DELETE'], $name));
    }

    public function match(ServerRequestInterface $request): ?Route
    {
        $result = $this->router->match($request);
        if ($result->isSuccess()) {
            return new Route(
                $result->getMatchedRouteName(),
                $result->getMatchedMiddleware(),
                $result->getMatchedParams()
            );
        }
        return null;
    }

    public function generateUri(string $name, array $params = [], array $queryParams = []): ?string
    {
       $uri = $this->router->generateUri($name, $params);
       if (!empty($queryParams)){
        return $uri . '?' . http_build_query($queryParams);
       }
       return $uri;
    }

    public function crud(string $prefixPath, $callable, string $prefixName)
    {
        $this->get("$prefixPath", $callable, "$prefixName.index");
        $this->get("$prefixPath/new", $callable, "$prefixName.create");
        $this->post("$prefixPath/new", $callable);
        $this->get("$prefixPath/{id:\d+}", $callable, "$prefixName.edit");
        $this->post("$prefixPath/{id:\d+}", $callable);
        $this->delete("$prefixPath/{id:\d+}", $callable, "$prefixName.delete");
    }
}