<?php

namespace App\Pages\Jeunesse\Collège;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class CollègeController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@collège/index.html.twig', [
            'controller_name' => 'CollègeController',
        ]);
    }
}