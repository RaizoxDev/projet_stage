<?php

use App\Framework\Session\PHPSession;
use App\Framework\Twig\FormExtension;
use App\Framework\Twig\FlashExtension;
use App\Framework\Session\SessionInterface;
use App\Framework\Renderer\RendererInterface;
use App\Framework\Router\RouterTwigExtension;
use App\Framework\Twig\PagerFantaExtension;
use App\Framework\Renderer\TwigRendererFactory;

return [
    'database.host' => 'localhost',
    'database.username' => 'root',
    'database.password' => '',
    'database.name' => 'centre_social',
    'views.path' => dirname(__DIR__) . '/views',
    'twig.extensions' => [
        \DI\get(RouterTwigExtension::class),
        \DI\get(PagerfantaExtension::class),
        \DI\get(FlashExtension::class),
        \DI\get(FormExtension::class),
    ],
    SessionInterface::class => \DI\autowire(PHPSession::class),
    \App\Framework\Router::class => \DI\autowire(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
    \PDO::class => function (\Psr\Container\ContainerInterface $c) 
    {
        return new PDO(
            'mysql:host=' . $c->get('database.host') . 'dbname=' . $c->get('database.name'),
            $c->get('database.username'),
            $c->get('database.password'),
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
];