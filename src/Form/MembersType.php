<?php

namespace App\Form;

use App\Entity\Posts;
use App\Entity\Members;
use App\Form\EventSubscriber\PostsFormSubscriber;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\{AbstractType, FormBuilderInterface, FormEvent, FormEvents};
use Symfony\Component\Form\Extension\Core\Type\{UrlType, FileType, TextType, ChoiceType, TextareaType};

class MembersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('grade', ChoiceType::class, [
                'label' => 'Rôle',
                'choices' => [
                    'Administrateur' => 'admin',
                    'Salarié' => 'member',
                    'Bénévole' => 'benevol'
                ],
                'placeholder' => 'Choisir un rôle'
            ])
            ->add('branch', ChoiceType::class, [
                'label' => 'Branche',
                'choices' => [
                    'Les Membres du Bureau' => 'mb',
                    'Les Autres Membres du CA' => 'ca',
                    'Pôle Pilotage' => 'pp',
                    'Pôle Logistique et Administratif' => 'pla',
                    'Pôle Accompagnement, Information et Orientation des habitants' => 'paio',
                    "Pôle Projets d'habitants" => 'pph',
                    'Pôle Actions Socioéducatives Enfance' => 'pase',
                    'Pôle Actions Socioéducatives Jeunesse' => 'pasj',
                    'Pôle Familles, Parentalité et Animation Vie Sociale Locale' => 'pfpa',
                    'Animation Loisirs Créatifs' => 'alc',
                    'Animation Radio' => 'ar',
                    'Animation Cyber Base' => 'acb'
                ],
                'placeholder' => "Choisir une branche d'activité",
                'attr' => [
                    'data-role-map' => json_encode([
                        'admin' => ['mb', 'ca'],
                        'member' => ['pp', 'pla', 'paio', 'pph', 'pase', 'pasj', 'pfpa'],
                        'benevol' => ['alc', 'ar', 'acb']
                    ])
                ]
            ])
            ->add('name', TextType::class)
            ->add('job', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Members::class,
        ]);
    }
}