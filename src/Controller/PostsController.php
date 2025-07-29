<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Form\MembersType;
use App\Repository\PostsRepository;
use App\Repository\MembersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostsController extends AbstractController
{
    private function processFormData(FormInterface $form, Posts $post, EntityManagerInterface $em): void
    {
        if ($post->getPage() === 'membres' && $form->has('membre')) {
            $member = $form->get('membre')->getData();

            if ($member) {
                $this->fillMissingPostFields($post, $member->getName());
                $post->setMembre($member);
                $em->persist($member);
            }
        } else {
            $file = $form->get('image')->getData();
            $this->handleImageUpload($file, $post, 'setImage');
        }
    }

    private function handleImageUpload(?UploadedFile $file, object $entity, string $setterMethod): string
    {
        $filename = $file 
            ? uniqid().'.'.$file->guessExtension()
            : 'PlaceHolder.png';
        
        if ($file) {
            $file->move($this->getParameter('images_directory'), $filename);
        }
        
        $entity->{$setterMethod}($filename);
        return $filename;
    }

    private function fillMissingPostFields(Posts $post, string $fallbackName): void
    {
        if (!$post->getName()) {
            $post->setName('Profil Membre - ' . $fallbackName);
        }

        if (!$post->getSlug()) {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $post->getName()));
            $slug = trim($slug, '-');
            $post->setSlug();
        }

        if (!$post->getDescription()) {
            $post->setDescription('Profil Membre');
        }

        if (!$post->getImage()) {
            $post->setImage('PlaceHolder.png');
        }

        if (!$post->getCreatedAt()) {
            $post->setCreatedAt(new \DateTimeImmutable());
        }

        if (!$post->getUpdatedAt()) {
            $post->setUpdatedAt(new \DateTimeImmutable());
        }
    }

    public function modify(int $id, Request $request, EntityManagerInterface $em, PostsRepository $postRepo, MembersRepository $memberRepo): Response
    {
        $isMember = str_contains($request->getPathInfo(), '/membermodify/');
        
        if ($isMember) {
            $entity = $memberRepo->find($id);
            $formType = MembersType::class;
        } else {
            $entity = $postRepo->find($id);
            $formType = PostsType::class;
        }

        if (!$entity) {
            throw $this->createNotFoundException('Entry not found');
        }

        $form = $this->createForm($formType, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processFormData($form, $entity, $em);
            
            $em->flush();
            $this->addFlash('success', 'Post modifié.');
            return $this->redirectToRoute('modifylist');
        }

        return $this->render('@admin/forms/form.html.twig', [
            'form' => $form->createView(),
            'entity' => $entity,
            'is_edit' => true,
            'is_member' => $isMember
        ]);
    }

    public function add(Request $request, EntityManagerInterface $em, PostsRepository $postRepo): Response
    {
        $post = new Posts();
        $post->setCreatedAt(new \DateTimeImmutable());

        if ($page = $request->query->get('page')) {
            $post->setPage($page);
        }

        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $post = $form->getData();

                if ($post->getPage() === 'membres' && $form->has('membre')) {
                    $member = $form->get('membre')->getData();

                    $this->fillMissingPostFields($post, $member->getName());

                    if ($member) {
                        $em->persist($member);

                        $post->setMembre($member);
                    }

                    $em->persist($post);
                } else {
                    $em->persist($post);
                }

                $em->flush();
            }
        }

        $latestPosts = $postRepo->findLatest(6);

        return $this->render('@admin/forms/form.html.twig', [
            'form' => $form->createView(),
            'posts' => $latestPosts,
            'is_edit' => false,
        ]);
    }

    public function delete(int $id, PostsRepository $postsRepository, EntityManagerInterface $em): Response 
    {
        $post = $postsRepository->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Post introuvable.');
        }

        $image = $post->getImage();

        if ($image && $image !== 'PlaceHolder.png') {
            $imagePath = $this->getParameter('kernel.project_dir') . '/public/uploads/images/' . $image;

            if (file_exists($imagePath)) {
                try {
                    unlink($imagePath);
                } catch (\Throwable $e) {}
            }
        }

        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Post supprimé avec son image.');

        return $this->redirectToRoute('list');
    }

    public function ajaxForm(Request $request, FormFactoryInterface $formFactory): JsonResponse
    {
        $page = $request->query->get('page');

        if (!$page) {
            return new JsonResponse(['html' => '<p>Page invalide</p>'], 400);
        }

        try {
            $post = new Posts();
            $post->setPage($page);
            $form = $formFactory->create(PostsType::class, $post);

            if ($form->has('membre')) {
                $html = $this->renderView('@admin/forms/membersform.html.twig', [
                    'form' => $form->get('membre')->createView(),
                ]);
            } else {
                $html = $this->renderView('@admin/forms/regularform.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            return new JsonResponse(['html' => $html]);
        } catch (\Throwable $e) {
            return new JsonResponse(['html' => '<p>Erreur serveur : '.$e->getMessage().'</p>'], 500);
        }
    }
}