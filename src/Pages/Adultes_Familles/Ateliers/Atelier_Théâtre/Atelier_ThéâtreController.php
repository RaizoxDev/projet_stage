<?php

namespace App\Pages\Adultes_Familles\Ateliers\Atelier_Théâtre;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class Atelier_ThéâtreController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@AT/index.html.twig', [
            'controller_name' => 'Atelier_ThéâtreController',
        ]);
    }
}