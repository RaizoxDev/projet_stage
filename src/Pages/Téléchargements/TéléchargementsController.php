<?php

namespace App\Pages\Téléchargements;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class TéléchargementsController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@téléchargements/index.html.twig', [
            'controller_name' => 'TéléchargementsController',
        ]);
    }
}
