<?php

namespace App\Pages\Jeunesse\Info_Jeunes;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class Info_JeunesController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@IJ/index.html.twig', [
            'controller_name' => 'Info_JeunesController',
        ]);
    }
}