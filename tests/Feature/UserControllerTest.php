<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
  public function testLoginPage()
  {
    $this->get('/login')
      ->assertSeeText('Login');
  }

  public function testLoginSuccess()
  {
    $this->post('/login', [
      'user' => 'dicky',
      'password' => 'dicky'
    ])->assertRedirect('/')
      ->assertSessionHas('user', 'dicky');
  }

  public function testLoginValidationError()
  {
    $this->post('/login', [])
      ->assertSeeText('User or password is required');
  }

  public function testLoginFailed()
  {
    $this->post('/login', [
      'user' => 'dasd',
      'password' => 'asdsad'
    ])->assertSeeText('User or password wrong');
  }

  public function testLogout()
  {
    $this->withSession([
      'user' => 'dicky'
    ])->post('/logout')
      ->assertRedirect('/')
      ->assertSessionMissing('user');
  }
}
