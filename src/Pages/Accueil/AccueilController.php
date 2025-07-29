<?php

namespace App\Pages\Accueil;

use App\Entity\Posts;
use App\Repository\PostsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AccueilController extends AbstractController
{
    public function index(?int $id, PostsRepository $postsRepo): Response
    {
        $posts = $postsRepo->findLatest(6);

        $post = null;
        if ($id !== null) {
            $post = $postsRepo->find($id);
            if (!$post) {
                throw $this->createNotFoundException("Post not found.");
            }
        }

        return $this->render('@accueil/index.html.twig', [
            'posts' => $posts,
            'post' => $post,
        ]);
    }
}