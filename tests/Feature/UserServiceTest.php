<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class UserServiceTest extends TestCase
{
  private UserService $userService;

  protected function setUp(): void
  {
    parent::setUp();

    $this->userService = $this->app->make(UserService::class);
  }

  public function testLoginSuccess()
  {
    self::assertTrue($this->userService->login('dicky', 'dicky'));
  }

  public function testLoginUserNotFound()
  {
    self::assertFalse($this->userService->login('asd', 'asdsad'));
  }

  public function testLoginWrongPassword()
  {
    self::assertFalse($this->userService->login('dicky', 'asdsad'));
  }
}
