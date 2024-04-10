<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    public function testCreateUser()
    {
        $userRepositoryMock = $this->createStub(UserRepository::class);
        $user = new User();
        $user->setEmail("test@example.com");
        $user->setFirstName("John");
        $user->setLastName("Doe");

        $userRepositoryMock->method('save')->willReturn(true);

        $userRepositoryMock->save($user, true);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test@example.com', $user->getEmail());
    }
}
