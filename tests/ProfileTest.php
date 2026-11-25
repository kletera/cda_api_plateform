<?php

namespace App\Tests;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class ProfileTest extends WebTestCase
{
    public function testProfileReturnsTheAuthenticatedUser(): void
    {
        $client = self::createClient();
        $user = (new User())
            ->setEmail('profile@example.test')
            ->setFirstname('Camille')
            ->setLastname('Martin');
        (new \ReflectionProperty(User::class, 'id'))->setValue($user, 42);

        $jwtManager = $this->createMock(JWTTokenManagerInterface::class);
        $jwtManager->method('getUserIdClaim')->willReturn('username');
        $jwtManager->expects(self::once())->method('parse')
            ->with('profile-test-token')
            ->willReturn(['username' => $user->getUserIdentifier()]);

        $userProvider = $this->createMock(UserProviderInterface::class);
        $userProvider->expects(self::once())->method('loadUserByIdentifier')
            ->with($user->getUserIdentifier())
            ->willReturn($user);

        self::getContainer()->set('lexik_jwt_authentication.jwt_manager', $jwtManager);
        self::getContainer()->set('security.user.provider.concrete.app_user_provider', $userProvider);

        $client->request('GET', '/api/profil', server: ['HTTP_AUTHORIZATION' => 'Bearer profile-test-token']);

        self::assertResponseIsSuccessful();
        self::assertResponseHeaderSame('Content-Type', 'application/json');
        $profile = json_decode($client->getResponse()->getContent(), true, flags: JSON_THROW_ON_ERROR);
        self::assertArrayNotHasKey('@context', $profile);
        self::assertSame(42, $profile['id']);
        self::assertSame('profile@example.test', $profile['email']);
        self::assertSame('Camille', $profile['firstname']);
        self::assertSame('Martin', $profile['lastname']);
    }

    public function testProfileRequiresAuthentication(): void
    {
        self::createClient()->request('GET', '/api/profil');

        self::assertResponseStatusCodeSame(401);
    }
}
