<?php

namespace App\Pages\Association\Adhésion;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class AdhésionController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@adhésion/index.html.twig', [
            'controller_name' => 'AdhésionController',
        ]);
    }
}