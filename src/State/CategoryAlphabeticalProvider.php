<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @implements ProviderInterface<Category>
 */
final class CategoryAlphabeticalProvider implements ProviderInterface
{
    public function __construct(
        private readonly Security $security,
        private readonly CategoryRepository $category,
    ) {
    }

    public function provide(
        Operation $operation,
        array $uriVariables = [],
        array $context = []
    ): array {
        $category = $this->category->findCategory();

        return $category;
    }
}
