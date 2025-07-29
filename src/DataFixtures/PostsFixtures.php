<?php

namespace App\DataFixtures;

use App\Entity\Posts;
use App\DataFixtures\FakerFixtures;
use Doctrine\Persistence\ObjectManager;

class PostsFixtures extends FakerFixtures
{
    public function load(ObjectManager $manager): void
    {

        $arrayPage = [
            'Accueil',
            'Adhésion',
            'Membres',
            'ALSH',
            'Tap',
            'Aide aux Devoirs (Enfance)',
            'Tickets Sports',
            'Projets Jeunes',
            'Aide aux Devoirs (Jeunesse)',
            'Collège',
            'Info Jeunes',
            'Séjours',
            'Parentalité',
            'Temps Forts',
            'Atelier Théâtre',
            'Loisirs Créatifs',
            'France Services',
            'Emploi',
            'Cyber-Base',
            'Services Départementaux',
            'Partenaires',
            'Téléchargements'
        ];

        foreach ($arrayPage as $pageName) {
            $posts = new Posts();
            $posts->setName();
            $posts->setSlug();
            $posts->setDescription();
            $posts->setImage();
            $posts->setDownload();
            $posts->setPage($pageName);
            $posts->setCreatedAt($this->fakeDateTimeImmutable());
            $posts->setUpdatedAt($this->fakeDateTimeImmutable());
        }
        
        $manager->persist($posts);
        $manager->flush();
    }
}