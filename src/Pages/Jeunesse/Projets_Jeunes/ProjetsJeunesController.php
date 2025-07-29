<?php

namespace App\Pages\Jeunesse\Projets_Jeunes;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ProjetsJeunesController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@PJ/index.html.twig', [
            'controller_name' => 'ProjetsJeunesController',
        ]);
    }
}
