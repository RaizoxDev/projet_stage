<?php

namespace App\Pages\Accompagnement\Cyber_Base;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class CyberBaseController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@CB/index.html.twig', [
            'controller_name' => 'CyberBaseController',
        ]);
    }
}
