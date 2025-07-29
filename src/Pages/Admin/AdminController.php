<?php

namespace App\Pages\Admin;

use App\Entity\Users;
use App\Form\PostsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminController extends AbstractController
{
    public function index(): Response
    {
        if (! $this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException("Vous n'êtes pas Admin.");
            return $this->render('@accueil/index.html.twig');
        }
        return $this->render('@admin/index.html.twig');
    }
}