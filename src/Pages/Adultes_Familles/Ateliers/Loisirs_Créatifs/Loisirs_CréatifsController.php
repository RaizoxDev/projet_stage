<?php

namespace App\Pages\Adultes_Familles\Ateliers\Loisirs_Créatifs;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class Loisirs_CréatifsController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@LC/index.html.twig', [
            'controller_name' => 'Loisirs_CréatifsController',
        ]);
    }
}