<?php

namespace App\Pages\Accompagnement\Emploi;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class EmploiController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@emploi/index.html.twig', [
            'controller_name' => 'EmploiController',
        ]);
    }
}
