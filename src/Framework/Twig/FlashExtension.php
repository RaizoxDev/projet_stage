<?php

namespace App\Framework\Twig;

use Twig\TwigFunction;
use App\Framework\Session\FlashService;
use Twig\Extension\AbstractExtension;

class FlashExtension extends AbstractExtension
{
    public function __construct(private FlashService $flashService){}

    public function getFunctions(): array
    {
        return  [
            new TwigFunction('flash', [$this, 'getFlash'])
        ];
    }

    public function getFlash($type): ?string
    {
        return $this->flashService->get($type);
    }
}