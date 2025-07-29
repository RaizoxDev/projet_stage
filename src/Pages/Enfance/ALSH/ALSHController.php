<?php

namespace App\Pages\Enfance\ALSH;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ALSHController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@ALSH/index.html.twig', [
            'controller_name' => 'ALSHController',
        ]);
    }
}
