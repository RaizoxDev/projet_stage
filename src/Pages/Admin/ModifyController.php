<?php

namespace App\Pages\Admin;

use App\Repository\PostsRepository;
use App\Repository\MembersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModifyController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@admin/modify.html.twig');
    }

    public function accueil(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'accueil'],
            ['createdAt' => 'DESC']
        );

        return $this->render('@admin/modify/accueilList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function association(): Response
    {
        return $this->render('@admin/modify/association/association.html.twig');
    }

    public function enfance(): Response
    {
        return $this->render('@admin/modify/enfance/enfance.html.twig');
    }

    public function jeunesse(): Response
    {
        return $this->render('@admin/modify/jeunesse/jeunesse.html.twig');
    }

    public function famille(): Response
    {
        return $this->render('@admin/modify/famille/famille.html.twig');
    }

    public function accompagnement(): Response
    {
        return $this->render('@admin/modify/accompagnement/accompagnement.html.twig');
    }

    public function partenaires(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'partenaires'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/partenairesList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function telechargements(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'accueil'],
            ['createdAt' => 'ASC']
        );
        
        return $this->render('@admin/modify/téléchargementsList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function adhesion(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'adhesion'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/association/adhesionList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function membres(MembersRepository $memberRepo, PostsRepository $postsRepo): Response
    {
        $members = $memberRepo->findAll();
        $posts = $postsRepo->findBy(
            ['page' => 'membres'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/association/membresList.html.twig', [
            'members' => $members,
            'posts' => $posts,
            'post_page' => 'membres'
        ]);
    }

    public function alsh(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'alsh'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/enfance/alshList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function tap(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'tap'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/enfance/tapList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function aade(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'aade'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/enfance/aadeList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function tickets(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'ts'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/jeunesse/ticketsList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function projets(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'pj'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/jeunesse/projetsList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function aadj(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'aadj'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/jeunesse/aadjList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function ij(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'ij'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/jeunesse/ijList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function college(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'college'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/jeunesse/collegeList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function sejours(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'sejours'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/jeunesse/sejoursList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function theatre(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'at'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/famille/theatreList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function loisirs(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'alc'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/famille/loisirsList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function parentalite(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'parentalite'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/famille/parentaliteList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function tempsforts(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'tf'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/famille/tempsfortsList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function franceservices(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'fs'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/accompagnement/franceservicesList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function emploi(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'emploi'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/accompagnement/emploiList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function cyberbase(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'cb'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/accompagnement/cyberbaseList.html.twig', [
            'posts' => $posts
        ]);
    }

    public function services(PostsRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(
            ['page' => 'sd'],
            ['createdAt' => 'ASC']
        );

        return $this->render('@admin/modify/accompagnement/servicesList.html.twig', [
            'posts' => $posts
        ]);
    }
}