<?php

namespace App\DataFixtures;

use App\Entity\Members;
use App\DataFixtures\FakerFixtures;
use Doctrine\Persistence\ObjectManager;

class MembersFixtures extends FakerFixtures
{
    public function load(ObjectManager $manager): void
    {
        $members = new Members();
        $members->setName($this->faker->word());
        $members->setGrade($this->faker->word());
        $members->setBranch($this->faker->sentence());
        $members->setJob($this->faker->sentence());

        $manager->flush();
    }
}