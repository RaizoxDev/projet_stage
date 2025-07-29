<?php

namespace App\Pages\Accompagnement\Services_Départementaux;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class Services_DépartementauxController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@SD/index.html.twig', [
            'controller_name' => 'Services_DépartementauxController',
        ]);
    }
}