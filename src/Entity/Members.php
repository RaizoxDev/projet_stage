<?php

namespace App\Entity;

use App\Repository\MembersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembersRepository::class)]
class Members
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $grade = null;

    #[ORM\Column(length: 255)]
    private ?string $branch = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $job = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getBranch(): ?string
    {
        return $this->branch;
    }

    public function setBranch(string $branch): static
    {
        $this->branch = $branch;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getGradeLabel(): ?string
    {
        $gradeLabels = [
            'admin' => 'Administration',
            'member' => 'Salarié',
            'benevol' => 'Bénévole'
        ];

        return $gradeLabels[$this->grade] ?? $this->grade;
    }

    public function getBranchLabel(): ?string
    {
        $branchLabels = [
            'mb' => 'Membre Bureau',
            'ca' => 'Cercle Administratif',
            'pp' => 'Pôle Pilotage',
            'pla' => 'Pôle Logistique et Administratif',
            'paio' => 'Pôle Accompagnement, Information et Orientation des Habitants',
            'pph' => "Pôle Projets d'Habitants",
            'pase' => 'Pôle Actions Socioéducatives Enfance',
            'pasj' => 'Pôle Actions Socioéducatives Jeunesse',
            'pfpa' => 'Pôle Familes, Parentalité et Animation Vie Sociale Locale',
            'alc' => 'Atelier Loisirs Créatifs',
            'ar' => 'Atelier Radio',
            'acb' => 'Atelier Cyber Base'
        ];

        return $branchLabels[$this->branch] ?? $this->branch;

        return $this->render('@admin/modify/association/membresList.html.twig', [
            'members' => $members,
        ]);
    }
}
