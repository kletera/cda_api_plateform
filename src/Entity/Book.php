<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\BookRepository;
use App\State\AuthorProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups as AttributeGroups;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/books/{author}',
            uriVariables: ['author'=>'string'],
            provider: AuthorProvider::class,
            normalizationContext: ['groups' => ['book:author']],
            outputFormats: ['json' => ['application/json']],
        ),
    ]
)]
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[AttributeGroups(['category:book', 'book:author'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[AttributeGroups(['category:book', 'book:author'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $resume = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $publishAt = null;

    #[ORM\Column(length: 50)]
    #[AttributeGroups(['category:book', 'book:author'])]
    private ?string $author = null;

    #[ORM\ManyToOne]
    private ?User $user = null;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class)]
    private Collection $categories;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPublishAt(): ?\DateTimeImmutable
    {
        return $this->publishAt;
    }

    public function setPublishAt(\DateTimeImmutable $publishAt): static
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }
}
