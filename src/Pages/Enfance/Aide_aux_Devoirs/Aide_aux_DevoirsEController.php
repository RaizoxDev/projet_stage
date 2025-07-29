<?php

namespace App\Pages\Enfance\Aide_aux_Devoirs;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class Aide_aux_DevoirsEController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@AaDE/index.html.twig', [
            'controller_name' => 'Aide_aux_DevoirsEController',
        ]);
    }
}
