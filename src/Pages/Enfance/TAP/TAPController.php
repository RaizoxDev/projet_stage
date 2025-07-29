<?php

namespace App\Pages\Enfance\TAP;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class TAPController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@TAP/index.html.twig', [
            'controller_name' => 'TAPController',
        ]);
    }
}
