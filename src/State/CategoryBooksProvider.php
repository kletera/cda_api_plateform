<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

use App\Repository\BookRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @implements ProviderInterface<BookRepository>
 */
final class CategoryBooksProvider implements ProviderInterface
{
    public function __construct(
        private readonly Security $security,
        private readonly BookRepository $book,
    ) {
    }

    public function provide(
        Operation $operation,
        array $uriVariables = [],
        array $context = []
    ): array {

        $categoryId = $uriVariables['id'] ?? null;

        if (null === $categoryId) {
            return [];
        }

        $books = $this->book->findByCategoryId($categoryId);

        return $books;
    }
}
