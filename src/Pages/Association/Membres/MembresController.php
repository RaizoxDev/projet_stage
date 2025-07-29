<?php

namespace App\Pages\Association\Membres;

use App\Repository\MembersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MembresController extends AbstractController
{
    public function index(MembersRepository $membersRepo): Response
    {
        $members = $membersRepo->findAll();

        return $this->render('@membres/index.html.twig', [
            'members' => $members,
        ]);
    }
}
