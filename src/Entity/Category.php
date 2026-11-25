<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use App\State\CategoryAlphabeticalProvider;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Attribute\Groups as AttributeGroups;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/category/{id}', 
            requirements: ['id' => '\d+'],
        ),
        new GetCollection(
            uriTemplate: '/categories',
        ),
        new Post(
            uriTemplate:'/category',
            status: 301
        ),
        new GetCollection(
            uriTemplate: '/categories/alphabetical',
            provider: CategoryAlphabeticalProvider::class,
            normalizationContext: ['groups' => ['category:alphabetical']],
        ),
    ],
    order: ['id' => 'ASC', 'name' => 'ASC'],
    paginationEnabled: false
)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[AttributeGroups(['category:alphabetical'])]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: false)]
    #[AttributeGroups(['category:alphabetical'])]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
