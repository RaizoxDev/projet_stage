<?php

namespace App\Pages\Jeunesse\Aide_aux_Devoirs;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class Aide_aux_DevoirsJController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@AaDJ/index.html.twig', [
            'controller_name' => 'Aide_aux_DevoirsJController',
        ]);
    }
}
