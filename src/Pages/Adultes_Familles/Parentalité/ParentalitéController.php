<?php

namespace App\Pages\Adultes_Familles\Parentalité;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ParentalitéController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@parentalité/index.html.twig', [
            'controller_name' => 'ParentalitéController',
        ]);
    }
}