<?php

namespace App\Controller;

use App\DB\Repository\CategoriesRepository;
use App\DB\Repository\UserRepository;
use App\DB\Repository\PostsRepository;
use App\DB\Repository\ContentRepository;
use App\DB\Repository\DownloadsRepository;
use App\DB\Repository\ProjectsRepository;
use App\DB\Repository\MembersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

final class MainController extends AbstractController
{
    public function index(
        CategoriesRepository $cateRepo,
        UserRepository $userRepo,
        PostsRepository $postsRepo,
        MembersRepository $membersRepo
        ): Response
    {
        $categories = $cateRepo->findAll();
        $user = $userRepo->findAll();
        $posts = $postsRepo->findAll();
        $members = $membersRepo->findAll();

        return $this->render('main/index.html.twig', [
            'categories' => $categories,
            'user' => $user,
            'posts' => $posts,
            'members' => $members
        ]);
    }
}
