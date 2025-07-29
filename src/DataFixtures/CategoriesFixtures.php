<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\DataFixtures\FakerFixtures;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends FakerFixtures
{
    public function load(ObjectManager $manager): void
    {
        $arrayCategory = [
            1 => [
                'title' => 'Association',
                'slug' => 'association',
                'parent' => [
                    1 => [
                        'title' => 'Adhésion',
                        'slug' => 'adhesion'
                    ],
                    2 => [
                        'title' => 'Membres',
                        'slug' => 'membres'
                    ]
                ]
            ],
            2 => [
                'title' => 'Activités',
                'slug' => 'activités',
                'parent' => [
                    1 => [
                        'title' => 'Enfance',
                        'slug' => 'enfance'
                    ],
                    2 => [
                        'title' => 'Jeunesse',
                        'slug' => 'jeunesse',
                        'parent' => [
                            1 => [
                                'title' => 'Projets Jeunes',
                                'slug' => 'projets_jeunes'
                            ]
                        ]
                    ],
                    3 => [
                        'title' => 'Aide aux Devoirs',
                        'slug' => 'aide_aux_devoirs'
                    ],
                    4 => [
                        'title' => 'Adultes-Familles',
                        'slug' => 'adultes_familles'
                    ],
                    5 => [
                        'title' => 'Atelier Théâtre',
                        'slug' => 'atelier_theatre'
                    ]
                ]
            ],
            4 => [
                'title' => 'Cyber-Base',
                'slug' => 'cyber_base'
            ],
            5 => [
                'title' => 'Animations Ponctuelles',
                'slug' => 'animations_ponctuelles'
            ],
            6 => [
                'title' => 'Emploi',
                'slug' => 'emploi'
            ],
            7 => [
                'title' => 'Permanances',
                'slug' => 'permanances'
            ],
            8 => [
                'title' => 'Partenaires',
                'slug' => 'partenaires'
            ]
        ];
        
    foreach($arrayCategory as $index => $item)
    {
        $parentCategory = new Categories();
        $parentCategory->setName($item['title']);
        $parentCategory->setSlug($item['slug']);
        $parentCategory->setParent(null);
        $parentCategory->setCreatedAt($this->fakeDateTimeImmutable());
        $parentCategory->setUpdatedAt($this->fakeDateTimeImmutable());

        $manager->persist($parentCategory);
        if (isset($item['parent'])) {
            foreach ($item['parent'] as $key => $value)
            {
                $childCategory = new Categories();
                $childCategory->setName($value['title']);
                $childCategory->setSlug($value['slug']);
                $childCategory->setParent($parentCategory);
                $childCategory->setCreatedAt($this->fakeDateTimeImmutable());
                $childCategory->setUpdatedAt($this->fakeDateTimeImmutable());

                $manager->persist($childCategory);
            }
        }
    }

    $manager->flush();
    }
}