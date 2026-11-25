<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

use App\Repository\BookRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @implements ProviderInterface<BookRepository>
 */
final class AuthorProvider implements ProviderInterface
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

        $author = $uriVariables['author'] ?? null;
        
        $books = $this->book->findByAuthor($author);

        if([]=== $books)  throw new NotFoundHttpException('Aucun livre trouvé pour cet auteur.');

        return $books;
    }
}
