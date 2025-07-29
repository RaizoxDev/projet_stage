<?php

namespace App\Pages\Accompagnement\France_Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class France_ServicesController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@FS/index.html.twig', [
            'controller_name' => 'France_ServicesController',
        ]);
    }
}