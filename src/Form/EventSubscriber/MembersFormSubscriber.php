<?php

namespace App\Form\EventSubscriber;

use App\Form\MembersType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MembersFormSubscriber implements EventSubscriberInterface
{
    private ?string $forcedPage;

    public function __construct(?string $forcedPage = null){$this->forcedPage = $forcedPage;}

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPreSetData(FormEvent $event): void
    {
        $data = $event->getData();
        $page = $this->forcedPage ?? ($data ? $data->getPage() : null);

        $this->setupFields($event->getForm(), $page);
    }

    public function onPreSubmit(FormEvent $event): void
    {
        $page = $event->getData()['page'] ?? $this->forcedPage;
        $this->setupFields($event->getForm(), $page);
    }

    private function toggleField(FormInterface $form, string $fieldName, bool $shouldExist, string $type, array $options = []): void
    {
        if ($shouldExist && !$form->has($fieldName)) {
            $form->add($fieldName, $type, $options);
        } elseif (!$shouldExist && $form->has($fieldName)) {
            $form->remove($fieldName);
        }
    }

    private function setupFields(FormInterface $form, ?string $page): void
    {
         $fieldsToRemove = ['name', 'membre', 'description', 'download'];
        foreach ($fieldsToRemove as $field) {
            if ($form->has($field)) {
                $form->remove($field);
            }
        }

        if (!$page) {
            return;
        }

        if ($page === 'membres') {
            $form->add('membre', MembersType::class, [
                'label' => false,
                'required' => false,
            ]);
        } else {
            $form->add('name', TextType::class, ['label' => 'Nom du post']);
            $form->add('description', TextareaType::class);
            $form->add('download', UrlType::class, ['required' => false]);
            $form->add('image', FileType::class, [
                'label' => 'Image (JPEG, PNG, WEBP)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                        'mimeTypesMessage' => 'Formats acceptés : JPG, PNG, WEBP',
                    ]),
                ],
            ]);
        }
    }
}