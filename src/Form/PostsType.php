<?php

namespace App\Form;

use App\Entity\Posts;
use App\Form\MembersType;
use Symfony\Component\Form\Event\PreSetDataEvent;
use Symfony\Component\Validator\Constraints\File;
use App\Form\EventSubscriber\MembersFormSubscriber;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\{FormEvents, AbstractType, FormBuilderInterface};
use Symfony\Component\Form\Extension\Core\Type\{UrlType, FileType, TextType, ChoiceType, TextareaType};

class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('page', ChoiceType::class, [
                'label' => 'Page',
                'choices' => [
                    'Accueil' => 'accueil',
                    'Adhésion' => 'adhesion',
                    'Membres' => 'membres',
                    'Centre de Loisirs' => 'alsh',
                    'TAP' => 'tap',
                    'Aide aux Devoirs (Enfance)' => 'aade',
                    'Tickets Sports' => 'ts',
                    'Projets de Jeunes' => "pj",
                    'Aide aux Devoirs (Jeunesse)' => 'aadj',
                    'Collège' => 'college',
                    'Info Jeunes' => 'ij',
                    'Séjours' => 'sejours',
                    'Parentalité' => 'parentalite',
                    'Temps Forts' => 'tf',
                    'Atelier Théâtre' => 'at',
                    'Loisirs Créatifs' => 'lc',
                    'France Services' => 'fs',
                    'Emploi' => 'emploi',
                    'Cyber Base' => 'cb',
                    'Services Départementaux' => 'sd',
                    'Partenaires' => 'partenaires',
                    'Téléchargements' => 'telechargements'
                ],
                'placeholder' => 'Choisir la page',
            ]);

            $builder->addEventSubscriber(new MembersFormSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}