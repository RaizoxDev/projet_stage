<?php

namespace App\Pages\Jeunesse\Séjours;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class SéjoursController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@séjours/index.html.twig', [
            'controller_name' => 'SéjoursController',
        ]);
    }
}