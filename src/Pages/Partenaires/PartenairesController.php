<?php

namespace App\Pages\Partenaires;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class PartenairesController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@partenaires/index.html.twig', [
            'controller_name' => 'PartenairesController',
        ]);
    }
}
