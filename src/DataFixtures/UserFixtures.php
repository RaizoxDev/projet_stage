<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\DataFixtures\FakerFixtures;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends FakerFixtures
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher){}

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('admin@admin.admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));
        $manager->persist($admin);
        $manager->flush();
    }
}