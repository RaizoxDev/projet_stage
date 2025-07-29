<?php

namespace App\Pages\Adultes_Familles\Temps_Forts;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class Temps_FortsController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@TF/index.html.twig', [
            'controller_name' => 'Temps_FortsController',
        ]);
    }
}