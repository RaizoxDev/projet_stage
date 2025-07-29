<?php

namespace App\Pages\Jeunesse\Tickets_Sport;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class Tickets_SportController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@TS/index.html.twig', [
            'controller_name' => 'Tickets_SportController',
        ]);
    }
}