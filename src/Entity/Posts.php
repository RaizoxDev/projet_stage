<?php

namespace App\Entity;

use App\Entity\Members;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostsRepository;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id", type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: "name", type: 'string')]
    private ?string $name = null;

    #[ORM\Column(name: "slug", type: 'string')]
    private ?string $slug = null;

    #[ORM\Column(name: "description", type: 'text')]
    private ?string $description = null;

    #[ORM\Column(name: "image", type: 'string')]
    private ?string $image = null;

    #[ORM\Column(name: "download", type: 'string', nullable: true)]
    private ?string $download = null;

    #[ORM\Column(name: "page", type: 'string')]
    private ?string $page = null;

    #[ORM\Column (name: "createdAt", type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: "updatedAt", type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $value = null): self
    {
        $base = $value ?? $this->name ?? '';
        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', $base), '-'));
        $this->slug = $slug ?: 'post-' . uniqid();

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDownload(): ?string
    {
        return $this->download;
    }

    public function setDownload(string $download): static
    {
        $this->download = $download;

        return $this;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function setPage(string $page): static
    {
        $this->page = $page;

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\OneToOne(targetEntity: Members::class, cascade: ['persist', 'remove'])]
    private ?Members $membre = null;

    public function getMembre(): ?Members
    {
        return $this->membre;
    }

    public function setMembre(?Members $membre): static
    {
        $this->membre = $membre;
        return $this;
    }

    #[ORM\PreRemove]
    public function deleteImageFile(): void
    {
        file_put_contents(__DIR__ . '/../../var/log/delete_test.log', 'PRE REMOVE OK'.PHP_EOL, FILE_APPEND);

        if ($this->image && $this->image !== 'PlaceHolder.png') {
            $imagePath = __DIR__ . '/../../public/uploads/images/' . $this->image;
            if (file_exists($imagePath)) {
                try {
                    unlink($imagePath);
                } catch (\Throwable $e) {}
            }
        }
    }
}